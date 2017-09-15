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
            $postdata = array(
                'status' => 1,
                'messege' => 'Siswa berhasil didaftarkan'
            );
            echo json_encode($postdata);
            mysqli_close($conn);
            exit;
        }
        else
        {
            $postdata = array(
                'status' => 0,
                'messege' => 'Siswa gagal didaftarkan'
            );
            echo json_encode($postdata);
            mysqli_close($conn);
            exit;
        }

    }
?>
