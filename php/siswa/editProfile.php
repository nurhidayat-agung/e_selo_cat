<?php

    include "../connection.php";
    
    $nis = $_POST['nis'];
    $password = $_POST['password'];
    $namaSiswa = $_POST['namaSiswa'];
    $idAngkatan = $_POST['idAngkatan'];
    $idPleton = $_POST['idPleton'];
    $idKompi = $_POST['idKompi'];

        $query = "UPDATE siswa SET namaSiswa = '$namaSiswa' , password='$password',idAngkatan = $idAngkatan, idPleton = $idPleton, idKompi = $idKompi WHERE nis = $nis";
        if(mysqli_query($conn, $query))
        {   
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('edit Profile BERHASIL, silahkan login kembali')
            window.location.href='../../logout.php';
            </SCRIPT>");
            exit;
        }
        else
        {
            echo false;
            mysqli_close($conn);
            exit;
        }
?>

