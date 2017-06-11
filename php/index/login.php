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
if (isset($data->username)) {
    $username = $data->username;
    $password = $data->password;
    $query = mysqli_query($conn,"SELECT idUser,username,job,nama,password FROM user WHERE username='$username'");
    $row = mysqli_fetch_assoc($query);
    if($row['password']==$password){
        $_SESSION['idUser'] = $row['idUser'];
        $_SESSION['login_username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
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
