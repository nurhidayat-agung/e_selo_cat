<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/30/2017
 * Time: 4:13 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idUser = $data->idUser;
        $query = "select * from banksoal";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
    }
?>