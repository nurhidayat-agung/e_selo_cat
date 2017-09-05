<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 3:32 PM
 */
include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    $nip_nrp = $data->nip_nrp;
    $query = "SELECT b.idBankSoal,b.namaBankSoal FROM banksoal AS b INNER JOIN timpengajar AS t ON "
        ."b.idTimPengajar = t.idTimPengajar INNER JOIN detailtimpengajar AS d ON "
        ."t.idTimPengajar = d.idTimPengajar WHERE d.nip_nrp = '$nip_nrp'";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
}
?>