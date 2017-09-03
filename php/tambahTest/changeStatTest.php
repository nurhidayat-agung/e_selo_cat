<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 6:39 PM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idTest = $data->idTest;
        $status = $data->status;
        $query = "UPDATE testing SET status = '$status' WHERE idTest = $idTest";
        if (mysqli_query($conn,$query)){
            echo false;
            mysqli_close($conn);
            exit;
        }else{
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>