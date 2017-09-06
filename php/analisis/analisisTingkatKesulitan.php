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
            $query = "SELECT idSoal FROM soaldetail WHERE idBankSoal = $idBankSoal";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_object($result)){
                $idSoals[] = $row->idSoal;
            }
            $jmlSiswa = getJmlSiswa($conn,$idBankSoal);
            foreach ($idSoals as $idSoal){
                $b = getJmlBenar($idBankSoal,$idSoal,$conn)/$jmlSiswa;
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
                $postData = array(
                    'status' => true,
                    'message' => 'tingkat kesulitan direset'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
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