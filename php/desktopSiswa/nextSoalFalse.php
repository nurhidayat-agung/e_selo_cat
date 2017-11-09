<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 30/10/17
 * Time: 07:41 ص
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0) {
        $idBankSoal = $data->idBankSoal;
        $jenis = $data->jenis;
        $dayaBeda = $data->dayaBeda;
        $tingkatKesulitanSoal = $data->tingkatKesulitanSoal;
        $idSoals = $data->idSoals;
        $cluster = 0;

        // nilai keanggotaan
        $aTurun = ((1.00 - $dayaBeda) / 1.00);
        $aNaik = (($dayaBeda - 0.00) / 1.00);
        $bnaik = (($tingkatKesulitanSoal - 0.00) / 1.00);
        $bTurun = ((1.00 - $tingkatKesulitanSoal) / 1.00);

        //predikat premis
        $pred1 = max($bTurun, $aNaik);
        $pred2 = max($bTurun, $aTurun);
        $pred3 = max($bnaik, $aNaik);
        $pred4 = max($bnaik, $aTurun);

        // konklusion of rule
        $z1Naik = ($pred1 - 0.00) * 10.0;
        $z2Naik = ($pred2 - 0.00) * 10.0;
        $z3Naik = ($pred3 - 0.00) * 10.0;
        $z4Turun = 10 - ($pred4 * 10.00);

        // defuzifikasi
        $zMean = ((($z1Naik * $pred1) + ($z2Naik * $pred2) + ($z3Naik * $pred3) + ($z4Turun * $pred4)) / ($pred1 + $pred2 + $pred3 + $pred4));
        if ($zMean >= 0.00 && $zMean <= 2.4999) {
            $cluster = 1;
        } else if ($zMean >= 2.5 && $zMean <= 4.999) {
            $cluster = 2;
        } else if ($zMean >= 5.00 && $zMean <= 7.4999) {
            $cluster = 3;
        } else if ($zMean >= 7.500 && $zMean <= 10.00) {
            $cluster = 4;
        }

        $query = "select * from soaldetail WHERE idSoal NOT IN ( " . implode($idSoals, ", ") . " ) and cluster = $cluster and jenisSoal = '$jenis'  limit 1";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $soal = $row;
        }

        $postData = array(
    //            'pred1' => $pred1,
    //            'pred2' => $pred2,
    //            'pred3' => $pred3,
    //            'pred4' => $pred4,
    //            'z1' => $z1Naik,
    //            'z2' => $z2Naik,
    //            'z3' => $z3Naik,
    //            'z4' => $z4Turun,
            'status' => true,
            'zMeans' => $zMean,
            'cluster' => $cluster,
            'soal' => $soal
        );
        echo json_encode($postData, JSON_NUMERIC_CHECK);
        exit;
    }
?>