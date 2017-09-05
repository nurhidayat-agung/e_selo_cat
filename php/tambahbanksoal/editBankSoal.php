<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 6:47 PM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $idTimPengajar = $data->idTimPengajar;
        $namaBankSoal = $data->namaBankSoal;
        $deskripsiBankSoal = $data->deskripsiBankSoal;
        $query = "UPDATE banksoal SET namaBankSoal = '$namaBankSoal', deskripsiBankSoal = '$deskripsiBankSoal', ".
            "idTimPengajar = $idTimPengajar WHERE idBankSoal = $idBankSoal;";
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
?>