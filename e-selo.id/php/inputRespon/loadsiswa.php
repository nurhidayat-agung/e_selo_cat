<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/10/2017
 * Time: 7:02 PM
 */
 include "../connection.php";
$output = array();
$query = "SELECT idUser,username FROM user where job = 'siswa'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result))
{
    $output[] = $row;
}
echo json_encode($output);

?>