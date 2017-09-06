<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/6/2017
 * Time: 9:04 AM
 */
include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    $namaPleton = $data->namaPleton;
    $keterangan = $data->keterangan;
    $query = "INSERT INTO pletonsiswa(namaPleton, keterangan) VALUES ('$namaPleton', '$keterangan')";
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