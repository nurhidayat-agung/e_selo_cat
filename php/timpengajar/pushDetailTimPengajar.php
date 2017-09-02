<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 5:47 AM
 */
    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $idTimPengajar = $request->idTimPengajar;
        $nip_nrp = $request->nip_nrp;
        $posisi = $request->posisi;
        $query = "INSERT INTO detailtimpengajar(idTimPengajar,nip_nrp,posisi) VALUES($idTimPengajar,$nip_nrp,'$posisi');";
        if(mysqli_query($conn, $query))
        {
            echo true;
            mysqli_close($conn);
            exit;
        }
        else
        {
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>