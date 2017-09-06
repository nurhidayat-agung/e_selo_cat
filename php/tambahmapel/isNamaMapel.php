<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 23/05/17
 * Time: 11:45
 */
include "../connection.php";

$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    if(isset($data->namaMapel)){
        $namaMapel = $data->namaMapel;
        $query = mysqli_query($conn,"select namaMapel from mapel where namaMapel = '$namaMapel'");
        $row = mysqli_fetch_row($query);
        if ($row == null){
            echo true;
            exit;
        }else{
            echo false;
            exit;
        }
    }
    mysqli_close($conn);
}

?>