<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 21/05/17
 * Time: 10:50
 */
include "../connection.php";
session_start();
$data = json_decode(file_get_contents("php://input"));
if (isset($data->nis)) {
    $nis = $data->nis;
    $password = $data->password;
    $query = mysqli_query($conn,"SELECT * FROM siswa WHERE nis = '$nis' ");
    $row = mysqli_fetch_assoc($query);
    if($row['password']==$password){
        $_SESSION['idUser'] = $row['namaSiswa'];
        $_SESSION['nis'] = $row['nis'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['idAngkatan'] = $row['idAngkatan'];
        $_SESSION['idPleton'] = $row['idPleton'];
        $_SESSION['status'] = 'siswa';
        $row['siswa'] = 'siswa';
        echo $row['siswa'];
        exit;
    }else {
        echo "gagal";
        exit;
    }
}else{
    echo "gagal";
    exit;
}
mysqli_close($conn);
?>
