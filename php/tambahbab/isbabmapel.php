<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 29/05/17
 * Time: 15:27
 */
include "../connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0){
    if (isset($data->namaBab) && isset($data->idMapel)){
        $namaBab = $data->namaBab;
        $idMapel = $data->idMapel;
        $query = mysqli_query($conn, "SELECT * FROM babmapel WHERE namaBabMapel like '$namaBab' AND idMapel = $idMapel");
        $row = mysqli_fetch_row($query);
        if ($row == null){
            echo true;
            exit;
        }else{
            echo false;
            exit;
        }
        mysqli_close($conn);
    }
}
?>