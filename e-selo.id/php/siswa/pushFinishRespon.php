<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/28/2017
 * Time: 6:03 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idResponTest = $data->idResponTest;
        $score = $data->score;
        $queryFinish = "UPDATE respontest SET nilaiResponTest = $score, status = 'finish' WHERE idResponTest = $idResponTest";
        if (mysqli_query($conn,$queryFinish)){
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