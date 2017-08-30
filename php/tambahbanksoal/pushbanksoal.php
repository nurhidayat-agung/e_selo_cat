<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/8/2017
 * Time: 7:46 PM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        if (isset($data->idUser) && isset($data->namaBankSoal)){
            $idUser = $data->idUser;
            $namaBankSoal = $data->namaBankSoal;
            $deskripsiBankSoal = $data->deskripsiBankSoal;
            $query = "INSERT INTO banksoal(idUser,namaBankSoal,deskripsiBankSoal) VALUES($idUser,'$namaBankSoal','$deskripsiBankSoal');";
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
    }
?>