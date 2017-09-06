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
        $query = "UPDATE siswa SET nis = $nis, namaSiswa = '$namaSiswa' , password='$password',idAngkatan = $idAngkatan, idPleton = $idPleton, idKompi = $idKompi WHERE nis = $nis";
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

