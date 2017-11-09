<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 11:14 PM
 */
include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    $nis = $data->nis;
    $output = array();
    $query = "SELECT * FROM testing WHERE idTest NOT IN (SELECT idTest FROM respontest ".
        "WHERE nis = $nis AND status = 'finish') AND status = 'open'";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;
}
?>