<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/23/2017
 * Time: 10:22 AM
 */
    function getJmlSiswa($conn,$idBankSoal){
        $queryJmlSiswa  = "SELECT COUNT(r.nis) AS jmlUser FROM respontest AS r INNER JOIN testing AS t ON ".
            "r.idTest = t.idTest WHERE t.idBankSoal = 12 AND r.jenis = 'klasik' AND r.status = 'finish'";
        $resultJmlSiswa = mysqli_query($conn,$queryJmlSiswa);
        $dataJmlSiswa = mysqli_fetch_assoc($resultJmlSiswa);
        return $dataJmlSiswa['jmlUser'];
    }

    function getJmlBenar($idBankSoal,$idSoal,$conn){
        $queryBenar = "SELECT COUNT(idSoal) as jmlBenar FROM detailrespon as d INNER JOIN respontest AS r".
            " ON d.idResponTest = r.idResponTest INNER JOIN testing AS t ON r.idTest = t.idTest".
            " WHERE t.idBanksoal = $idBankSoal AND d.idSoal = $idSoal AND r.status = 'finish' AND r.jenis = 'klasik' AND d.croscek = 1";
        $resultBenar = mysqli_query($conn,$queryBenar);
        $jml = mysqli_fetch_assoc($resultBenar);
        return $jml['jmlBenar'];
    }

    function getJmlSalah($idBankSoal,$idSoal,$conn){
        $querySalah = "SELECT COUNT(idSoal) as jmlSalah FROM detailrespon as d INNER JOIN respontest AS r".
            " ON d.idResponTest = r.idResponTest INNER JOIN testing AS t ON r.idTest = t.idTest".
            " WHERE t.idBanksoal = $idBankSoal AND d.idSoal = $idSoal AND r.status = 'finish' AND r.jenis = 'klasik' AND d.croscek = 0";
        $resultBenar = mysqli_query($conn,$querySalah);
        $jml = mysqli_fetch_assoc($resultBenar);
        return $jml['jmlSalah'];
    }

    function pushB($idSoal,$b,$conn){
        $queryPushB = "UPDATE soaldetail SET tingkatKesulitanSoal = $b WHERE idSoal = $idSoal";
        return mysqli_query($conn,$queryPushB);
    }

    function getRawScore($conn,$idResponTest){
        $queryRawScore = "SELECT SUM(tingkatKesulitanSoal) as rawScore FROM soaldetail as s INNER JOIN detailrespon AS d ".
            "ON s.idSoal = d.idSoal INNER JOIN respontest as r on r.idResponTest = d.idResponTest".
            " WHERE r.idResponTest = $idResponTest AND d.croscek = 1";
        $resultRawScore = mysqli_query($conn, $queryRawScore);
        $rawScore = mysqli_fetch_assoc($resultRawScore);
        return $rawScore['rawScore'];
    }

    function getIdResponTest($conn,$idBankSoal){
        $queryIdRespontest = "SELECT idResponTest FROM respontest WHERE idBanksoal = $idBankSoal AND jenis = 'klasik' AND status = 'finish';";
        $resultIdRespontTest = mysqli_query($conn, $idBankSoal);
        $idResponTest = array();
        while ($row = mysqli_fetch_assoc($resultIdRespontTest)){
            $idResponTest[] = $row['idResponTest'];
        }
        return $idResponTest;
    }
?>