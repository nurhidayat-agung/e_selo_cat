<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/4/2017
 * Time: 2:39 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idResponTest = $data->idResponTest;
        $idTest = $data->idTest;
        $jenis = $data->jenis;
        $queryNext = "SELECT * FROM detailtest AS dt INNER JOIN soaldetail AS s ON dt.idSoal = s.idSoal ".
            "WHERE dt.idSoal not in (SELECT idSoal FROM `detailrespon` WHERE idResponTest = $idResponTest) ".
            "AND dt.idTest = $idTest AND s.jenisSoal = '$jenis' ORDER BY RAND() limit 1";
        $getNext = mysqli_query($conn, $queryNext);
        while($rowNext = mysqli_fetch_array($getNext))
        {
            $soalNext = $rowNext;
        }
        echo json_encode($soalNext);
        exit;

    }
?>


