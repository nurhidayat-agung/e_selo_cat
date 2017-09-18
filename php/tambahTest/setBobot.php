<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 10:15 PM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idSoal = $data->idSoal;
        $bobot = $data->bobot;
        $query = "UPDATE soaldetail SET bobot = $bobot WHERE idSoal = $idSoal";
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