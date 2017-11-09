<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/23/2017
 * Time: 2:59 PM
 */
    include "../connection.php";
    include "functionAnalisisResponButir.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $idRespontests = getIdResponTest($conn,$idBankSoal);
        $isRawUpdate = true;
        foreach ($idRespontests  as $idRespontest ){
            $rawScore = getRawScore($conn,$idRespontest);
            if ($rawScore >= 0){
                if (!updateRawScore($conn,$idRespontest,$rawScore)){
                    $isRawUpdate = false;
                }
            }
        }
        if ($isRawUpdate){
            $idSoals = getIdSoal($conn,$idBankSoal);
            $isAUpdate = true;
            if (count($idSoals) > 0){

                // lakukan perulangan proses untuk tiap idSoal
                foreach ($idSoals as $idSoal){
                    if (itemAValidCheck($conn,$idSoal)){
                        // mendapatkan jumlah siswa yang mengerjakan butir soal
                        // fungsi ini sama seperti gambar 4.6
                        $jmlSiswa = getJmlSiswa($conn,$idSoal);

                        // mendapatkan jumlah siswa pada kelompok bwah/atas
                        // bagi 3 berarti 33.33 % dari kelompok atas atau bawah
                        $jmlKasta = floor($jmlSiswa/3);

                        // mendapatkan jumlah benar pada kelompok atas
                        $ba = benarAtas($conn,$idSoal,$jmlKasta);

                        // mendapatkan jumlah benar pada kelompok bawah
                        $bb = benarBawah($conn,$idSoal,$jmlKasta);

                        // menghitung daya beda butir soal
                        $dayaBeda = (2 * ($ba - $bb)) / ($jmlKasta*2);

                        // update daya beda butir soal dalam data base
                        if (!pushA($conn,$idSoal,$dayaBeda)){
                            $isAUpdate = false;
                            $postData = array(
                                'status' => false,
                                'messege' => 'gagal saat update soal '. $idSoal
                            );
                            echo json_encode($postData);
                            mysqli_close($conn);
                            exit;
                        }
                    }
                }
                if ($isAUpdate){
                    $postData = array(
                        'status' => true,
                        'message' => 'daya beda dan tingkat kesulitan di update'
                    );
                    echo json_encode($postData);
                    mysqli_close($conn);
                    exit;
                }else{
                    $postData = array(
                        'status' => false,
                        'messege' => 'gagal saat update daya beda'
                    );
                    echo json_encode($postData);
                    mysqli_close($conn);
                    exit;
                }
            }else{
                $postData = array(
                    'status' => false,
                    'messege' => 'tidak ditemukan soal dalam bankSoal'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }
        }else{
            $postData = array(
                'status' => false,
                'messege' => 'raw score update failed'
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
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