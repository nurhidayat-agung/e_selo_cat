<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/5/2017
 * Time: 8:04 AM
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

