<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/27/2017
 * Time: 3:25 PM
 */
    include "../connection.php";
    include "NudyangKmeans.php";

    //clustering
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBanksoal = $data->idBankSoal;
        if ($data->status){
            $idSoalCluster = array();
            $tingkatKesulitan = array();
            $isClusterUpdate = true;
            $cmdClustering = "select tingkatKesulitanSoal from soalDetail where idBankSoal = $idBanksoal AND ".
                "dayaBeda >= 0.2 AND tingkatKesulitanSoal >= 0 ORDER BY tingkatKesulitanSoal DESC ,dayaBeda ASC";
            $rClustering = mysqli_query($conn,$cmdClustering);
            while($rowCluster = mysqli_fetch_array($rClustering)){
                $tingkatKesulitan[] = $rowCluster['tingkatKesulitanSoal'];
            }
            if (count($tingkatKesulitan)>1){
                $nudyangKmeans = new NudyangKmeans($tingkatKesulitan,$idBanksoal,4);
                if ($nudyangKmeans->isCluster()){
                    $output = $nudyangKmeans->getCentroid();
                    if ($output['status']){
                        $countCLuster = 0;
                        foreach ($output['cluster'] as $item => $value){
                            $cCluster = $item + 1;
                            if (count($value) == 1){
                                $queryCLuster = "UPDATE soaldetail SET cluster = $cCluster WHERE tingkatKesulitanSoal = $value[0] and dayaBeda >= 0.2";
                                if (!mysqli_query($conn,$queryCLuster)){
                                    $isClusterUpdate = false;
                                    $postData = array(
                                        'status' => false,
                                        'messege' => 'gagal update cluster pada '. $queryCLuster
                                    );
                                    echo json_encode($postData);
                                    mysqli_close($conn);
                                    exit;
                                }else{
                                    $countCLuster ++;
                                }
                            }else{
                                sort($value);
                                $valLow = $value[0];
                                $valHigh = $value[count($value) - 1];
                                $queryCLuster = "UPDATE soaldetail SET cluster = $cCluster WHERE dayaBeda >= 0.2 AND tingkatKesulitanSoal BETWEEN $valLow AND $valHigh";
                                if (!mysqli_query($conn,$queryCLuster)){
                                    $isClusterUpdate = false;
                                    $postData = array(
                                        'status' => false,
                                        'messege' => 'gagal update cluster pada '. $queryCLuster
                                    );
                                    echo json_encode($postData);
                                    mysqli_close($conn);
                                    exit;
                                }else{
                                    $countCLuster ++;
                                }
                            }
                        }
                        if ($isClusterUpdate && $countCLuster == count($output['cluster'])){
                            $postData = array(
                                'status' => true,
                                'messege' => 'semua data cluster berhasil di update'
                            );
                            echo json_encode($postData);
                            mysqli_close($conn);
                            exit;
                        }
                    }
                }else{
                    $postData = array(
                        'status' => false,
                        'messege' => 'Jumlah unique value dibawah jumlah kluster'
                    );
                    echo json_encode($postData);
                    mysqli_close($conn);
                    exit;
                }
            }else{
                $postData = array(
                    'status' => false,
                    'messege' => 'jumlah soal '.count($tingkatKesulitan).' tidak mencukupi untuk di kluster'
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