<?php

    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idKompi = $data->idKompi;
        $query = "DELETE FROM kompisiswa WHERE idKompi = $idKompi";
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