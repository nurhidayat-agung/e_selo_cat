<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/23/2017
 * Time: 9:19 AM
 */

    include "../connection.php";
    include "functionAnalisisResponButir.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        if ($data->status){
            $cekB = true;
            $idBankSoal = $data->idBankSoal;
            $idSoals = array();

            // ambil id soal dalam bank soal
            $idSoals = getIdSoal($conn,$idBankSoal);

            //lakukan perhitungan ditiap idsoal yang ditemukan
            foreach ($idSoals as $idSoal){

                // cek apakah id soal butir soal pernah disajikan
                if (itemBValidCheck($conn,$idSoal)){
                    // mendapakan total jumalah siswa yang mengerjakan butir soal
                    $jmlSiswa = getJmlSiswa($conn,$idSoal);

                    // membagi jumlah benar dengan total siswa yang mengerjakan soal
                    $b = getJmlBenar($idSoal,$conn)/$jmlSiswa;

                    //update tingkat kesulitan dalam data base
                    if (!pushB($idSoal,$b,$conn)){
                        $cekB = false;
                    }
                }

            }
            if ($cekB){
                $postData = array(
                    'status' => true,
                    'message' => 'tingkat kesulitan di update'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }else{
                $postData = array(
                    'status' => false,
                    'message' => 'kesalahan saat update tigkat kesulitan'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }
        }else{
            $idBankSoal = $data->idBankSoal;
            $queryResetB = "UPDATE soaldetail SET tingkatKesulitanSoal = null WHERE idBankSoal = $idBankSoal";
            if (mysqli_query($conn, $queryResetB)){
                $queryResetA = "UPDATE soaldetail SET dayaBeda = null WHERE idBankSoal = $idBankSoal";
                if (mysqli_query($conn,$queryResetA)){
                    $postData = array(
                        'status' => true,
                        'message' => 'daya beda dan tingkat kesulitan di reset'
                    );
                    echo json_encode($postData);
                    mysqli_close($conn);
                    exit;
                }else{
                    $postData = array(
                        'status' => false,
                        'message' => 'daya beda gagal direset'
                    );
                    echo json_encode($postData);
                    mysqli_close($conn);
                    exit;
                }
            }else{
                $postData = array(
                    'status' => false,
                    'message' => 'tingkat kesulitan gagal direset'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }
        }

    }else{
        $postData = array(
            'status' => false,
            'message' => 'wrong method'
        );
        echo json_encode($postData);
        exit;
    }

?>