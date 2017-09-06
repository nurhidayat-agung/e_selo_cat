<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/11/2017
 * Time: 5:50 PM
 */

include "../connection.php";
$output = array();
$data = json_decode(file_get_contents("php://input"));
$query = "SELECT idSoal,isiSoal,kunci FROM soalDetail WHERE idBankSoal = ".$data->idBankSoal."";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result))
{
    $output[] = $row;
}
echo json_encode($output);

?>