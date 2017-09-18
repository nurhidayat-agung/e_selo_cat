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
            $postData = array(
                'status' => 1,
                'messeage' => 'edit berhasil'
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }
        else
        {
            $postData = array(
                'status' => 0,
                'messeage' => 'edit gagal'
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }
    }
?>

