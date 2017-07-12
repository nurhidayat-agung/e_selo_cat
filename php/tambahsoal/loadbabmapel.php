<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/12/2017
 * Time: 8:51 AM
 */
include "../connection.php";
$output = array();
$data = json_decode(file_get_contents("php://input"));
$query = "SELECT idBabMapel,namaBabMapel FROM babMapel WHERE idMapel='".$data->idMapel."'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result))
{
    $output[] = $row;
}
echo json_encode($output);
?>