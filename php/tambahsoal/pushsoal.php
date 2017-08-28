<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/31/2017
 * Time: 5:30 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $isiSoal = $data->isiSoal;
        $pil1 = $data->pil1;
        $pil2 = $data->pil2;
        $pil3 = $data->pil3;
        $pil4 = $data->pil4;
        $babmapel = $data->babmapel;
        $kunci = $data->kunci;
        $query = "INSERT INTO soaldetail(idBankSoal, isiSoal, pil1, pil2, pil3, pil4, idBabMapel, kunci) VALUES($idBankSoal,'$isiSoal','$pil1','$pil2','$pil3','$pil4',$babmapel,'$kunci')";
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