<?php
include "../connection.php";

$data = json_decode(file_get_contents("php://input"));
if ($data != null){
    $nis =  $data->nis;       
    $namaSiswa = $data->namaSiswa;
    $password = $data->password;
    $idAngkatan = $data->idAngkatan;
    $idPleton = $data->idPleton;
    $idKompi = $data->idKompi;
    $query = "insert into siswa(nis, namaSiswa, password, idAngkatan, idPleton, idKompi) values($nis,'$namaSiswa','$password',$idAngkatan,$idPleton,$idKompi)";
    if (mysqli_query($conn,$query)) {
        echo true;
        mysqli_close($conn);
        exit;
    }else{
        echo false;
        mysqli_close($conn);
        exit;
    }
}
?>