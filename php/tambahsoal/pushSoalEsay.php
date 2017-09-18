<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/30/2017
 * Time: 7:35 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $isiSoal = $data->isiSoal;
        $pil1 = $data->pil1;
        $pil2 = $data->pil2;
        $pil3 = $data->pil3;
        $jumlahEsay = $data->jumlahEsay;
        $query = "INSERT INTO soaldetail(idBankSoal, isiSoal, pil1, pil2, pil3, jenisSoal, jumlahEsay, bobot) VALUES($idBankSoal,'$isiSoal','$pil1','$pil2','$pil3','Melengkapi',$jumlahEsay,1)";
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