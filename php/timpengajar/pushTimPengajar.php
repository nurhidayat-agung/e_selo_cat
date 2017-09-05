<?php

include "../connection.php";
$request = json_decode(file_get_contents("php://input"));
if (count($request) > 0){
    $namaTimPengajar = $request->namaTimPengajar;
    $keterangan = $request->keterangan;
    $query = "INSERT INTO timpengajar(namaTimPengajar,keterangan) VALUES('$namaTimPengajar','$keterangan')";
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
