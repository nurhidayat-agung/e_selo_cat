<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 9:05 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $nip_nrp = $data->idUser;
        $query = "select * from `user` where nip_nrp = $nip_nrp";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }

?>