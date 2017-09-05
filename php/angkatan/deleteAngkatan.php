<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/31/2017
 * Time: 3:31 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idAngkatan = $data->idAngkatan;
        $query = "DELETE FROM `angkatansiswa` WHERE `idAngkatan`= $idAngkatan";
        if(mysqli_query($conn, $query))
        {
            echo true;
            mysqli_close($conn);
            exit;
        }
        else
        {
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>