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
        if (isset($data->idMapel) && isset($data->idUser) && isset($data->namaBankSoal) && isset($data->jml_soal)){
            $idMapel = $data->idMapel;
            $idUser = $data->idUser;
            $namaBankSoal = $data->namaBankSoal;
            $jml_soal = $data->jml_soal;
            $deskripsiBankSoal = $data->deskripsiBankSoal;
            $query = "INSERT INTO banksoal(idMapel,idUser,namaBankSoal,jml_soal,deskripsiBankSoal) VALUES($idMapel,$idUser,'$namaBankSoal',$jml_soal,'$deskripsiBankSoal');";
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