<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 26/05/17
 * Time: 19:59
 */
    include "../connection.php";
     $output = array();
     $query = "SELECT idMapel,namaMapel FROM mapel";
     $result = mysqli_query($conn, $query);
     while($row = mysqli_fetch_assoc($result))
     {
         $output[] = $row;
     }
     echo json_encode($output);
?>