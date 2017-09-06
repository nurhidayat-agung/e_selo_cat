<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/4/2017
 * Time: 2:25 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $nis = $data->nis;
        $idTest = $data->idTest;
        $jenis = $data->jenis;
        $query = "INSERT INTO respontest(nis,idTest,jenis) VALUES ($nis,$idTest,'$jenis')";
        $idRespon = 0;
        if(mysqli_query($conn, $query))
        {
            $idRespon = mysqli_insert_id($conn);
            echo $idRespon;
            mysqli_close($conn);
            exit;
        }
        else
        {
            echo $idRespon;
            mysqli_close($conn);
            exit;
        }

    }
?>