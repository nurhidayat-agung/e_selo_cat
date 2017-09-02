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
if (isset($data->nip_nrp)) {
    $nip_nrp = $data->nip_nrp;
    $password = $data->password;
    $query = mysqli_query($conn,"SELECT nip_nrp,username,job,nama,password,email FROM user WHERE nip_nrp = $nip_nrp");
    $row = mysqli_fetch_assoc($query);
    if($row['password']==$password){
        $_SESSION['idUser'] = $row['nip_nrp'];
        $_SESSION['login_username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['job'] = $row['job'];
        echo $row['job'];
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
