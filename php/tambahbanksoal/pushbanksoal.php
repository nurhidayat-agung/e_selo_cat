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
        if (isset($data->idTimPengajar) && isset($data->namaBankSoal)){
            $idTimPengajar = $data->idTimPengajar;
            $namaBankSoal = $data->namaBankSoal;
            $deskripsiBankSoal = $data->deskripsiBankSoal;
            $query = "INSERT INTO banksoal(idTimPengajar,namaBankSoal,deskripsiBankSoal) ".
                "VALUES($idTimPengajar,'$namaBankSoal','$deskripsiBankSoal');";
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