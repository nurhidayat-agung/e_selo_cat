<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/27/2017
 * Time: 3:25 PM
 */
    include "../connection.php";
    include "NudyangKmeans2.php";
    include "functionKlustering.php";

    //clustering
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBanksoal = $data->idBankSoal;
        $lastCek = true;
        if ($data->status){
            $idSoalCluster = array();
            $tingkatKesulitan = array();
            $isClusterUpdate = true;

            // ambil karakteristik dan dayabeda dalam bank soal
            $getPreCluster = getKarakteristikButir($conn,$idBanksoal);

            // buat demo
            $a = array([0.8,0.2],[0.7,0.2],[0.6,0.4],[0.5,0.4],[0.5,0.6],[0.6,0.5],[0.1,0.2]);
            if ($getPreCluster['status']){

                //mulai proses clustering
                $nudyangKmeans = new NudyangKmeans2($getPreCluster['data']
                    ,$idBanksoal,4);
                if ($nudyangKmeans->isCluster()){

                    //output clustering
                    $outPut = $nudyangKmeans->getCentroid();
                    if ($outPut['status']){

                        //update data cluster di data base
                        foreach ($outPut['baru'] as $item => $values){
                            $clus = $item + 1;
                            foreach ($values as $depItem => $depvalue){
                                $queryCluster = "UPDATE soaldetail SET cluster = $clus WHERE".
                                    " tingkatKesulitanSoal = $depvalue[0] AND dayaBeda = $depvalue[1]";
                                if (!mysqli_query($conn,$queryCluster)){
                                    $lastCek = false;
                                    $postData = array(
                                        'status' => false,
                                        'messege' => 'error saat melakukan update kluster soal pada'.
                                            ' daya beda = '.$depvalue[1].'dan tingkat kesulitan = '.
                                            $depvalue[0]
                                    );
                                    echo json_encode($postData);
                                    mysqli_close($conn);
                                    exit;
                                }
                            }

                        }
                        if ($lastCek){
                            setBorderBankSoal($conn,$idBanksoal);
                            $postData = array(
                                'status' => true,
                                'messege' => 'proses clustering berhasil',
                                'result'=> $outPut
                            );
                            echo json_encode($postData,JSON_NUMERIC_CHECK);
                            mysqli_close($conn);
                            exit;
                        }else{
                            $postData = array(
                                'status' => false,
                                'messege' => 'last cek false'
                            );
                            echo json_encode($postData);
                            mysqli_close($conn);
                            exit;
                        }

                    }else{
                        $postData = array(
                            'status' => false,
                            'messege' => 'terjadi kesalahan dalam iterasi pengklsuteran, jumlah iterasi '.$outPut['perulangan']
                        );
                        echo json_encode($postData);
                        mysqli_close($conn);
                        exit;
                    }
                    // end test

                    exit;
                }else{
                    $postData = array(
                        'status' => false,
                        'messege' => 'jumlah soal '.count($getPreCluster[data]).' tidak mencukupi untuk di kluster'
                    );
                    echo json_encode($postData);
                    mysqli_close($conn);
                    exit;
                }

                exit;
            }else{
                $postData = array(
                    'status' => false,
                    'messege' => 'jumlah soal '.count($getPreCluster['data']).' tidak mencukupi untuk di kluster'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }

        }else{
            $queryReset = "UPDATE soaldetail SET cluster = NULL WHERE idBankSoal = $idBanksoal";
            if (mysqli_query($conn,$queryReset)){
                $postData = array(
                    'status' => true,
                    'messege' => 'soal banksoal '.$idBanksoal.' berhasil direset'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }else{
                $postData = array(
                    'status' => false,
                    'messege' => 'soal banksoal '.$idBanksoal.' gagal direset'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }
        }

    }else{
        $postData = array(
            'status' => false,
            'messege' => 'wrong method'
        );
        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }
?>

