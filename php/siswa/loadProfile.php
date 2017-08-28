<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/28/2017
 * Time: 10:14 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idUser = $data->idUser;
        $query = "SELECT * FROM user WHERE idUser = $idUser";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $postData = $row;
        }
        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }
?>