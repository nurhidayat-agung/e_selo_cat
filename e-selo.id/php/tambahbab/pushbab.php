<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/6/2017
 * Time: 9:04 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        if (isset($data->namaBabMapel) && isset($data->idMapel)){
            $idMapel = $data->idMapel;
            $namaBabMapel = $data->namaBabMapel;
            $deskripsiBabMapel = $data->deskripsiBabMapel;
            $query = "INSERT INTO babMapel(idMapel, namaBabMapel, deskripsiBabMapel) VALUES ($idMapel, '$namaBabMapel','$deskripsiBabMapel')";
            if(mysqli_query($conn, $query))
            {
                echo true;
                exit;
            }
            else
            {
                echo false;
                exit;
            }
            mysqli_close($conn);
        }
    }
?>