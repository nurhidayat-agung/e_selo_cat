<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 5:01 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idTest = $data->idTest;
        $query = "DELETE FROM testing WHERE idTest = $idTest";
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