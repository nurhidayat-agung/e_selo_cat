<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/9/2017
 * Time: 1:06 PM
 */

    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idSoal = $data->idSoal;
        $isiSoal = $data->isiSoal;
        $pil1 = $data->pil1;
        $pil2 = $data->pil2;
        $pil3 = $data->pil3;
        $pil4 = $data->pil4;
        $babmapel = $data->babmapel;
        $kunci = $data->kunci;
        $query = "UPDATE soaldetail SET isiSoal = '$isiSoal', pil1 = '$pil1', pil2 = '$pil2', pil3 = '$pil3', pil4 = '$pil4', kunci = '$kunci', idBabMapel = $babmapel WHERE idSoal = $idSoal;";
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