<?php

    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $idTimPengajar = $request->idTimPengajar;
        $namaTimPengajar = $request->namaTimPengajar;
        $keterangan = $request->keterangan;
        $query = "UPDATE timpengajar SET namaTimPengajar='$namaTimPengajar', keterangan='$keterangan' WHERE idTimPengajar = $idTimPengajar";
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

