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
            $idSoals = getIdSoal($conn,$idBankSoal);
            foreach ($idSoals as $idSoal){
                $jmlSiswa = getJmlSiswa($conn,$idSoal);
                $b = getJmlBenar($idSoal,$conn)/$jmlSiswa;
                if (!pushB($idSoal,$b,$conn)){
                    $cekB = false;
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