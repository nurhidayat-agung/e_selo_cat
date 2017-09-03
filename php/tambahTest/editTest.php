<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 5:02 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idTest = $data->idTest;
        $namaTest = $data->namaTest;
        $waktuTest = $data->waktuTest;
        $query = "UPDATE testing SET namaTest = '$namaTest', waktuTest = $waktuTest ".
            "WHERE idTest = $idTest";
        if (mysqli_query($conn, $query))
        {
            echo true;
        }
        else
        {
            echo false;
        }
        mysqli_close($conn);
        exit;
    }
?>