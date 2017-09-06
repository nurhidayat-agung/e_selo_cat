<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/4/2017
 * Time: 4:33 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idResponTest = $data->idResponTest;
        $idSoal = $data->idSoal;
        $croscek = $data->croscek;
        $kunci = $data->kunci;
        $jawab = $data->jawab;
        $query = "INSERT INTO detailrespon(idResponTest,idSoal,croscek,kunci,jawab) VALUES ($idResponTest,$idSoal,$croscek,'$kunci','$jawab')";
        if (mysqli_query($conn,$query)){
            echo true;
            mysqli_close($conn);
            exit;
        }else{
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>