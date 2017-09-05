<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/11/2017
 * Time: 10:38 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if(count($data) > 0){
        $query = "SELECT COUNT(*) FROM soalDetail WHERE idBankSoal ='".$data->idBankSoal."'";
        $result = mysqli_query($conn, $query);
        $output = mysqli_fetch_row($result);
        echo $output[0];
        exit;
    }

?>