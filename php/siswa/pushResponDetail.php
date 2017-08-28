<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/28/2017
 * Time: 3:57 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idResponTest = $data->idResponTest;
        $idSoal = $data->idSoal;
        $jawab = $data->jawab;
        $croscek = $data->croscek;
        $bankSoal = $data->bankSoal;

        $query = "INSERT INTO detailrespon(idResponTest, idSoal, jawab, croscek) VALUES ($idResponTest,$idSoal,'$jawab',$croscek)";
        if (mysqli_query($conn,$query)){
            $queryNext = "SELECT idSoal, isiSoal, pil1, pil2, pil3, pil4, kunci, dayaBeda, tingkatKesulitanSoal, cluster FROM `soalDetail` WHERE idSoal not in (SELECT idSoal FROM `detailrespon` WHERE idResponTest = $idResponTest) and idBankSoal = $bankSoal limit 1";
            $getNext = mysqli_query($conn, $queryNext);
            while($rowNext = mysqli_fetch_array($getNext))
            {
                $soalNext = $rowNext;
            }
            echo json_encode($soalNext);
            exit;
        }
    }

?>