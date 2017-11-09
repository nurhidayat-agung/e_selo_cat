<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 30/10/17
 * Time: 04:48 ص
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0) {
        $status = $data->status;
        $idBankSoal = $data->idBankSoal;
        $jenis = $data->jenis;
        $dayaBeda = $data->dayaBeda;
        $tingkatKesulitanSoal = $data->tingkatKesulitanSoal;
        $idSoals = $data->idSoals;
        $cluster = 0;

        $cmdBorder = "SELECT aMin,aMax,bMin,bMax FROM banksoal".
            " WHERE idBankSoal = $idBankSoal";
        $ressBorder = mysqli_query($conn,$cmdBorder);
        while ($row = mysqli_fetch_assoc($ressBorder)){
            $border = $row;
        }
        $aMin = $border['aMin'];
        $aMax = $border['aMax'];
        $aMinMax = $aMax - $aMin;
        $bMin = $border['bMin'];
        $bMax = $border['bMax'];
        $bMinMax = $bMax - $bMin;

        // nilai keanggotaan
        $aTurun = (($aMax - $dayaBeda) / $aMinMax);
        $aNaik = (($dayaBeda - $aMin) / $aMinMax);
        $bnaik = (($tingkatKesulitanSoal - $bMin) / $bMinMax);
        $bTurun = (($bMax - $tingkatKesulitanSoal) / $bMinMax);

        //predikat premis
        if ($status){
            $pred1 = max($bTurun, $aNaik);
            $pred2 = max($bTurun, $aTurun);
            $pred3 = max($bnaik, $aNaik);
            $pred4 = min($bnaik, $aTurun);
        }else{
            $pred1 = max($bTurun, $aNaik);
            $pred2 = max($bTurun, $aTurun);
            $pred3 = max($bnaik, $aNaik);
            $pred4 = min($bnaik, $aTurun);
        }

        // konklusion of rule
        if ($status){
            $z1 = ($pred1 - 0.00) * 10.0;
            $z2 = ($pred2 - 0.00) * 10.0;
            $z3 = ($pred3 - 0.00) * 10.0;
            $z4 = 10 - ($pred4 * 10.00);
        }else{
            $z1 = 10 - ($pred1 * 10.00);
            $z2 = 10 - ($pred2 * 10.00);
            $z3 = 10 - ($pred3 * 10.00);
            $z4 = ($pred4 - 0.00) * 10.0;
        }

        // defuzifikasi
        $zMean = ((($z1 * $pred1) + ($z2 * $pred2) + ($z3 * $pred3)
                + ($z4 * $pred4)) / ($pred1 + $pred2 + $pred3 + $pred4));

        //implikasi ke cluster
        if ($zMean >= 0.00 && $zMean < 2.5) {
            $cluster = 1;
        } else if ($zMean >= 2.5 && $zMean < 5.00) {
            $cluster = 2;
        } else if ($zMean >= 5.00 && $zMean < 7.5) {
            $cluster = 3;
        } else if ($zMean >= 7.500 && $zMean <= 10.00) {
            $cluster = 4;
        }

//        $query = "select * from soaldetail WHERE idSoal NOT IN ( "
//            . implode($idSoals, ", ") .
//            " ) and cluster = $cluster order by rand() limit 1";
//        $result = mysqli_query($conn,$query);
//        while ($row = mysqli_fetch_assoc($result)){
//            $soal = $row;
//        }

        $soal = getSoal($conn,$idBankSoal,$cluster,$idSoals,$jenis);

        if ($soal == null){
            if ($status){
                if ($cluster == 4){
                    $cluster = 3;
                    $soal = getSoal($conn,$idBankSoal,$cluster,$idSoals,$jenis);
                }else {
                    $cluster ++;
                    $soal = getSoal($conn,$idBankSoal,$cluster,$idSoals,$jenis);
                }
            }else{
                if ($cluster == 1){
                    $cluster = 2;
                    $soal = getSoal($conn,$idBankSoal,$cluster,$idSoals,$jenis);
                }else{
                    $cluster --;
                    $soal = getSoal($conn,$idBankSoal,$cluster,$idSoals,$jenis);
                }
            }
        }

        $postData = array(
            'status' => true,
            'aMin' => $aMin,
            'aMax' => $aMax,
            'aDist' => $aMinMax,
            'bMin' => $bMin,
            'bMax' => $bMax,
            'bDist' => $bMinMax,
            'aTurun' => $aTurun,
            'aNaik' => $aNaik,
            'bTurun' => $bTurun,
            'bNaik' => $bnaik,
            'pred1' => $pred1,
            'pred2' => $pred2,
            'pred3' => $pred3,
            'pred4' => $pred4,
            'z1' => $z1,
            'z2' => $z2,
            'z3' => $z3,
            'z4' => $z4,
            'zMeans' => $zMean,
            'cluster' => $cluster,
            'soal' => $soal
        );
        echo json_encode($postData, JSON_NUMERIC_CHECK);
        exit;
    }

    function getSoal($conn,$idBankSoal,$cluster,$idSoals,$jenis) {
        $pushSoal = null;
        $query = "select * from soaldetail WHERE idSoal NOT IN ( "
            . implode($idSoals, ", ") .
            " ) and cluster = $cluster and idBankSoal = $idBankSoal".
            " and jenisSoal = '$jenis' order by rand() limit 1";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $pushSoal = $row;
        }
        return $pushSoal;
    }

?>