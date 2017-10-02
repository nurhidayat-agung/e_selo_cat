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
            if (!updateRawScore($conn,$idRespontest,$rawScore)){
                $isRawUpdate = false;
            }
        }
        if ($isRawUpdate){
            $idSoals = getIdSoal($conn,$idBankSoal);
            $isAUpdate = true;
            if (count($idSoals) > 0){
                foreach ($idSoals as $idSoal){
                    $jmlSiswa = getJmlSiswa($conn,$idSoal);
                    $jmlKasta = floor($jmlSiswa/2);
                    $ba = benarAtas($conn,$idSoal,$jmlKasta);
                    $bb = benarBawah($conn,$idSoal,$jmlKasta);
                    $dayaBeda = (2 * ($ba - $bb)) / $jmlSiswa;
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