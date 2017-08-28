<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/14/2017
 * Time: 10:38 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if(count($data) > 0)
    {
        $idResponTest = $data->idResponTest;
        $status = $data->status;
        $nilai = $data->nilai;
        $query = "update responTest set status = '$status', nilaiResponTest = $nilai where idResponTest = $idResponTest";
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

