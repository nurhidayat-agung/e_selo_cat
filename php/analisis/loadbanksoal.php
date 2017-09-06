s<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/11/2017
 * Time: 1:57 AM
 */

include "../connection.php";
 $output = array();
 $data = json_decode(file_get_contents("php://input"));
 $idMapel = $data->idMapel;
 $query = "SELECT * FROM banksoal WHERE idMapel = $idMapel";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_array($result))
 {
     $output[] = $row;
 }
 echo json_encode($output);
?>