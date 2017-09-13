<?php

    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $nis = $request->nis;
        $namaSiswa = $request->namaSiswa;
        $password = $request->password;
        $idAngkatan = $request->idAngkatan;
        $idPleton = $request->idPleton;
        $idKompi = $request->idKompi;
        $query = "INSERT INTO siswa(nis, namaSiswa, password, idAngkatan, idPleton, idKompi) VALUES($nis, '$namaSiswa','$password',$idAngkatan, $idPleton, $idKompi)";
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
