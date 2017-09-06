<?php
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $namaKompi = $data->namaKompi;
        $keterangan = $data->keterangan;
        $query = "INSERT INTO kompisiswa(namaKompi, keterangan) VALUES ('$namaKompi', '$keterangan')";
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