<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/31/2017
 * Time: 2:50 AM
 */
include "../connection.php";
$query = "select * from pletonsiswa";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)){
    $output[] = $row;
}
echo json_encode($output);
mysqli_close($conn);
exit;
?>