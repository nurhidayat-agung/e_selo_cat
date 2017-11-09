<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 5:00 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data)){
        $idBankSoal = $data->idBankSoal;
        $namaTest = $data->namaTest;
        $jenisTest = $data->jenisTest;
        $waktuTest = $data->waktuTest;
        $scoreItem = $data->scoreItem;
        $jmlPilGanda = $data->jmlPilGanda;
        $jmlEssay = $data->jmlEssay;
        $isSuskes = true;
        $arrIdPg = array();
        $arrIdEs = array();
        $query = "INSERT INTO testing(idBankSoal,namaTest,jenisTest,waktuTest,scoreItem,jmlPilGanda,jmlEssay,status)".
            " VALUES($idBankSoal,'$namaTest','$jenisTest',$waktuTest,$scoreItem,$jmlPilGanda,$jmlEssay,'close')";
        if (mysqli_query($conn,$query)){
            $postData = array(
                'status' => true,
                'messege' => 'test berhasil dibuat'
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }else{
            $postData = array(
                'status' => false,
                'messege' => 'test gagal dibuat'
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }
    }
?>

<!--$idTest = mysqli_insert_id($conn);-->
<!--$query2 = "SELECT idSoal FROM soaldetail AS s INNER JOIN banksoal AS b ON s.idBankSoal = b.idBankSoal ".-->
<!--"WHERE s.idBankSoal = $idBankSoal AND s.jenisSoal = 'Pilihan Ganda' ORDER BY rand() LIMIT $jmlPilGanda";-->
<!--$resultPilGan = mysqli_query($conn,$query2);-->
<!--while ($row = mysqli_fetch_assoc($resultPilGan)){-->
<!--$arrIdPg[] = $row['idSoal'];-->
<!--}-->
<!--for ($a = 0; $a < count($arrIdPg); $a++){-->
<!--$queryPushdet = "INSERT INTO detailtest(idTest,idSoal,bobotSoal) VALUES($idTest,$arrIdPg[$a],1);";-->
<!--if (!mysqli_query($conn,$queryPushdet)){-->
<!--$isSuskes = false;-->
<!--}-->
<!--}-->
<!--if ($isSuskes){-->
<!--$query3 = "SELECT idSoal FROM soaldetail AS s INNER JOIN banksoal AS b ON s.idBankSoal = b.idBankSoal ".-->
<!--"WHERE s.idBankSoal = $idBankSoal AND s.jenisSoal = 'Melengkapi' ORDER BY rand() LIMIT $jmlEssay";-->
<!--$resultPilEs = mysqli_query($conn,$query3);-->
<!--while ($row = mysqli_fetch_assoc($resultPilEs)){-->
<!--$arrIdEs[] = $row['idSoal'];-->
<!--}-->
<!--for ($a = 0; $a < count($arrIdEs); $a++){-->
<!--$queryPushdet = "INSERT INTO detailtest(idTest,idSoal,bobotSoal) VALUES($idTest,$arrIdEs[$a],1);";-->
<!--if (!mysqli_query($conn,$queryPushdet)){-->
<!--$isSuskes = false;-->
<!--}-->
<!--}-->
<!--echo $isSuskes;-->
<!--mysqli_close($conn);-->
<!--exit;-->
<!--}else{-->
<!--echo $isSuskes;-->
<!--mysqli_close($conn);-->
<!--exit;-->
<!--}-->
