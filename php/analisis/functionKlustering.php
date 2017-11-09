<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 02/11/17
 * Time: 08:12 ص
 */
    function getKarakteristikButir($conn, $idBankSoal){
        $cmdClustering = "select tingkatKesulitanSoal,dayaBeda from soalDetail".
            " where idBankSoal = $idBankSoal AND dayaBeda BETWEEN 0.2 AND 1.0 and".
            " tingkatKesulitanSoal BETWEEN 0.1 and 0.9 ORDER BY tingkatKesulitanSoal".
            " DESC ,dayaBeda ASC";
        $tingkatKesulitan = array();
        $rClustering = mysqli_query($conn,$cmdClustering);
        while($rowCluster = mysqli_fetch_array($rClustering)){
            $tingkatKesulitan[] = [$rowCluster['tingkatKesulitanSoal'],
                $rowCluster['dayaBeda']];
        }
        if (count($tingkatKesulitan) > 0){
            $output = array(
                'status' => true,
                'data' => $tingkatKesulitan
            );
        }else{
            $output = array(
                'status' => false,
                'data' => $tingkatKesulitan
            );
        }
        return $output;
    }

    function setBorderBankSoal($conn,$idBankSoal){
        $cmdBmin = "SELECT tingkatKesulitanSoal FROM soaldetail".
            " WHERE idBankSoal = $idBankSoal AND cluster between".
            " 1 and 4 ORDER BY tingkatKesulitanSoal asc limit 1";
        $resBmin = mysqli_query($conn,$cmdBmin);
        while ($row = mysqli_fetch_assoc($resBmin)){
            $tmpBmin = $row['tingkatKesulitanSoal'];
        }
        $cmdPushBMin = "UPDATE banksoal SET bMin = $tmpBmin WHERE".
            " idBankSoal = $idBankSoal";
        mysqli_query($conn,$cmdPushBMin);
        $cmdBmax = "SELECT tingkatKesulitanSoal FROM soaldetail".
            " WHERE idBankSoal = $idBankSoal AND cluster between".
            " 1 and 4 ORDER BY tingkatKesulitanSoal desc limit 1";
        $resBmax = mysqli_query($conn,$cmdBmax);
        while ($row = mysqli_fetch_assoc($resBmax)){
            $tmpBmax = $row['tingkatKesulitanSoal'];
        }
        $cmdPushBmax = "UPDATE banksoal SET bMax = $tmpBmax WHERE".
            " idBankSoal = $idBankSoal";
        mysqli_query($conn,$cmdPushBmax);
        $cmdAmin = "SELECT dayaBeda FROM soaldetail WHERE".
            " idBankSoal = $idBankSoal AND cluster BETWEEN 1 AND".
            " 4 ORDER BY dayaBeda asc limit 1";
        //
        $resAmin = mysqli_query($conn,$cmdAmin);
        while ($row = mysqli_fetch_assoc($resAmin)){
            $tmpAmin = $row['dayaBeda'];
        }
        $cmdPushAMin = "UPDATE banksoal SET aMin = $tmpAmin WHERE".
            " idBankSoal = $idBankSoal";
        mysqli_query($conn,$cmdPushAMin);
        //
        $cmdAMax = "SELECT dayaBeda FROM soaldetail WHERE".
            " idBankSoal = $idBankSoal AND cluster BETWEEN 1 AND".
            " 4 ORDER BY dayaBeda DESC limit 1";
        $resAmax = mysqli_query($conn,$cmdAMax);
        while ($row = mysqli_fetch_assoc($resAmax)){
            $tmpAmax = $row['dayaBeda'];
        }
        $cmdPushAMax = "UPDATE banksoal SET aMax = $tmpAmax WHERE".
            " idBankSoal = $idBankSoal";
        mysqli_query($conn,$cmdPushAMax);
    }

?>