<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 21/05/17
 * Time: 14:53
 */
include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    if(isset($data->nis){
        $nis = $data->nis;
        $query = mysqli_query($conn,"select nis from siswa where nis = $nis ");
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