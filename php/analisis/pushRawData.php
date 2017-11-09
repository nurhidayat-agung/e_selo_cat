<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 13/10/17
 * Time: 01:29 م
 */
    include "../connection.php";
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.1,0.2,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.1,0.3,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.2,0.3,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.2,0.4,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.3,0.5,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.3,0.6,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.4,0.7,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.5,0.8,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.5,1.0,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.5,0.9,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.6,0.8,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.7,0.7,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.7,0.6,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.8,0.4,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.9,0.3,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.9,0.2,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.9,0.2,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.9,0.3,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',0.9,0.2,12)";
    mysqli_query($conn,$query);
    $query = "INSERT INTO soaldetail(isiSoal,tingkatKesulitanSoal,dayaBeda,idBankSoal) VALUES('rawsoal',1.0,0.0,12)";
    mysqli_query($conn,$query);
    $postData = array(
        'status' => true,
        'message' => "16 raw butir soal di input"
    );
    echo json_encode($postData);
?>