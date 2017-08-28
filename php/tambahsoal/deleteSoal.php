<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/10/2017
 * Time: 9:26 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idSoal = $data->idSoal;
        $query = "DELETE FROM soaldetail WHERE idSoal = $idSoal";
        if (mysqli_query($conn, $query)){
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