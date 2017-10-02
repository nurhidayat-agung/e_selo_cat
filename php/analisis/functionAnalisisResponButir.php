<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/23/2017
 * Time: 10:22 AM
 */
    function getIdSoal($conn,$idBankSoal){
        $queryIdSoals = "SELECT idSoal FROM soaldetail WHERE idBankSoal = $idBankSoal";
        $resIdSoals = mysqli_query($conn, $queryIdSoals);
        $idSoals = array();
        while ($row = mysqli_fetch_assoc($resIdSoals)){
            $idSoals[] = $row['idSoal'];
        }
        return $idSoals;
    }

    function getJmlSiswa($conn,$idSoal){
        /*
        $queryJmlSiswa  = "SELECT COUNT(r.nis) AS jmlUser FROM respontest AS r INNER JOIN testing AS t ON ".
            "r.idTest = t.idTest WHERE t.idBankSoal = $idBankSoal AND r.jenis = 'klasik' AND r.status = 'finish'";
        */
        $queryJmlSiswa = "SELECT COUNT(*) AS jmlSiswa FROM detailrespon WHERE idSoal = $idSoal";
        $resultJmlSiswa = mysqli_query($conn,$queryJmlSiswa);
        $dataJmlSiswa = mysqli_fetch_assoc($resultJmlSiswa);
        return $dataJmlSiswa['jmlSiswa'];
    }

    function getJmlBenar($idSoal,$conn){
        /*
        $queryBenar = "SELECT COUNT(idSoal) as jmlBenar FROM detailrespon as d INNER JOIN respontest AS r".
            " ON d.idResponTest = r.idResponTest INNER JOIN testing AS t ON r.idTest = t.idTest".
            " WHERE t.idBanksoal = $idBankSoal AND d.idSoal = $idSoal AND r.status = 'finish' AND r.jenis = 'klasik' AND d.croscek = 1";
        */
        $queryBenar = "SELECT COUNT(*) AS jmlBenar FROM detailrespon WHERE idSoal = $idSoal AND croscek = 1";
        $resultBenar = mysqli_query($conn,$queryBenar);
        $jml = mysqli_fetch_assoc($resultBenar);
        return $jml['jmlBenar'];
    }

    function getJmlSalah($idSoal,$conn){
        /*
        $querySalah = "SELECT COUNT(idSoal) as jmlSalah FROM detailrespon as d INNER JOIN respontest AS r".
            " ON d.idResponTest = r.idResponTest INNER JOIN testing AS t ON r.idTest = t.idTest".
            " WHERE t.idBanksoal = $idBankSoal AND d.idSoal = $idSoal AND r.status = 'finish' AND r.jenis = 'klasik' AND d.croscek = 0";
        */
        $querySalah = "SELECT COUNT(*) AS jmlSalah FROM detailrespon WHERE idSoal = $idSoal AND croscek = 0";
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
        $queryIdRespontest = "SELECT idResponTest FROM respontest AS r INNER JOIN testing AS t ON r.idTest = t.idTest ".
            "WHERE t.idBanksoal = $idBankSoal AND r.jenis = 'klasik' AND r.status = 'finish'";
        $resultIdRespontTest = mysqli_query($conn, $queryIdRespontest);
        $idResponTest = array();
        while ($row = mysqli_fetch_assoc($resultIdRespontTest)){
            $idResponTest[] = $row['idResponTest'];
        }
        return $idResponTest;
    }

    function updateRawScore($conn,$idResponTest,$rawScore){
        $queryUpdateRawScore = "UPDATE respontest SET rawScore = $rawScore WHERE idResponTest = $idResponTest;";
        if (mysqli_query($conn,$queryUpdateRawScore)){
            return true;
        }else{
            return false;
        }
    }

    function benarAtas($conn,$idSoal,$jmlKasta){
        $queryBenarAtas = "SELECT COUNT(*) AS benarAtas FROM detailrespon AS dr1 INNER JOIN (SELECT dr.idRespontest ".
            "FROM detailrespon AS dr INNER JOIN respontest AS r ON dr.idResponTest =r.idResponTest WHERE idSoal = 1 ".
            "ORDER BY r.nilaiResponTest DESC, r.rawScore ASC LIMIT $jmlKasta) as respon ON dr1.idResponTest = respon.idResponTest ".
            "WHERE croscek = 1 AND dr1.idSoal = $idSoal";
        $resBenarAtas = mysqli_query($conn,$queryBenarAtas);
        $jmlBenarAtas = mysqli_fetch_assoc($resBenarAtas);
        return $jmlBenarAtas['benarAtas'];
    }

    function benarBawah($conn,$idSoal,$jmlKasta){
        $queryBenarBawah = "SELECT COUNT(*) AS benarBawah FROM detailrespon AS dr1 INNER JOIN (SELECT dr.idRespontest ".
            "FROM detailrespon AS dr INNER JOIN respontest AS r ON dr.idResponTest =r.idResponTest WHERE idSoal = 1 ".
            "ORDER BY r.nilaiResponTest ASC, r.rawScore DESC LIMIT $jmlKasta) as respon ON dr1.idResponTest = respon.idResponTest ".
            "WHERE croscek = 1 AND dr1.idSoal = $idSoal";
        $resBenarBawah = mysqli_query($conn,$queryBenarBawah);
        $jmlBenarBawah = mysqli_fetch_assoc($resBenarBawah);
        return $jmlBenarBawah['benarBawah'];
    }

    function pushA($conn,$idSoal,$a){
        $queryA = "UPDATE soaldetail SET dayaBeda = $a WHERE idSoal = $idSoal";
        return mysqli_query($conn,$queryA);
    }
?>