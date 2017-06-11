<?php
include "../connection.php";

$data = json_decode(file_get_contents("php://input"));
if ($data != null){
    $username =  $data->username;       
    $password = $data->password;
    $nama = $data->nama;
    $job = $data->job;
    $email = $data->email;
    $query = "insert into user(username,password,nama,job,email) values('$username','$password','$nama','$job','$email')";
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