<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/31/2017
 * Time: 2:50 AM
 */
    include "../../php/connection.php";
    $query = "select * from angkatansiswa";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)){
        $angkatan[] = $row;
    }
  

?>