<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/29/2017
 * Time: 5:09 AM
 */
    include "../connection.php";
    $query = "SELECT u.nama,b.namaBankSoal,r.nilaiResponTest FROM respontest as r ".
        "INNER JOIN banksoal AS b ON r.idBanksoal = b.idBankSoal INNER JOIN user AS u ".
        "ON r.idUser = u.idUser WHERE r.status = 'finish' ORDER BY r.idResponTest DESC limit 7";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;
?>