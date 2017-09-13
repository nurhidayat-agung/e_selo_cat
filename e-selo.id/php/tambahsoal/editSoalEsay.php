<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/30/2017
 * Time: 8:25 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idSoal = $data->idSoal;
        $idBankSoal = $data->idBankSoal;
        $isiSoal = $data->isiSoal;
        $pil1 = $data->pil1;
        $pil2 = $data->pil2;
        $pil3 = $data->pil3;
        $jumlahEsay = $data->jumlahEsay;
        $query = "UPDATE soaldetail SET isiSoal = '$isiSoal', pil1 = '$pil1', pil2 = '$pil2', pil3 = '$pil3', jumlahEsay = $jumlahEsay WHERE idSoal = $idSoal;";
        if (mysqli_query($conn, $query)){
            echo true;
            exit;
        }else{
            echo false;
            exit;
        }
        mysqli_close($conn);
        //        echo $babmapel;
    }
?>