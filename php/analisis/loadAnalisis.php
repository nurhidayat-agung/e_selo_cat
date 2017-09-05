<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/15/2017
 * Time: 6:49 AM
 */

    include "../connection.php";
    $output = array();
    $query = "SELECT idSoal, isiSoal, tingkatKesulitanSoal, dayaBeda, cluster FROM soalDetail WHERE idBankSoal = 11";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        $output[] = $row;
    }
    echo json_encode($output);

?>