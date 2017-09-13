<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 9:45 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $output = 0;
        $idUser = $data->idUser;
        $query = "SELECT COUNT(*) AS ketua FROM detailtimpengajar WHERE nip_nrp = $idUser AND posisi = 'ketua'";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output = $row['ketua'];
        }
        if ($output > 0){
            echo true;
            mysqli_close($conn);
            exit;
        }else{
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>