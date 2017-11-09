<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/17/2017
 * Time: 11:31 PM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $jmlPilGan = $data->jmlPilGan;
        $jmlEssay = $data->jmlEssay;
        $postData = array();
//        $queryPilgan = "SELECT * FROM soaldetail WHERE idBankSoal = $idBankSoal and jenisSoal = 'Pilihan Ganda' ORDER BY rand() limit $jmlPilGan";
        $queryPilgan = "SELECT * FROM soaldetail WHERE idBankSoal = $idBankSoal and jenisSoal = 'Pilihan Ganda' AND idSoal in (44,49,51,53,60,64,65,66,69) limit $jmlPilGan";
        $resPilgan = mysqli_query($conn,$queryPilgan);
        while ($row = mysqli_fetch_assoc($resPilgan)){
            $postData[] = $row;
        }
//        $queryEssay = "SELECT * FROM soaldetail WHERE idBankSoal = $idBankSoal and jenisSoal = 'Melengkapi' ORDER BY rand() limit $jmlEssay";
        $queryEssay = "SELECT * FROM soaldetail WHERE idBankSoal = $idBankSoal and jenisSoal = 'Melengkapi' and idSoal IN (48,73,74,75,76,78,80) limit $jmlEssay";
        $resEssay = mysqli_query($conn,$queryEssay);
        while ($row = mysqli_fetch_assoc($resEssay)){
            $postData[] = $row;
        }

        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }
?>