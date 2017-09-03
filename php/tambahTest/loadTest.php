<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 5:02 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $nip_nrp = $data->nip_nrp;
        $query = "SELECT * FROM testing AS t INNER JOIN banksoal AS b ON t.idBankSoal = b.idBankSoal ".
            "INNER JOIN timpengajar AS tp ON b.idTimPengajar = tp.idTimPengajar INNER JOIN detailtimpengajar AS dt ".
            "ON tp.idTimPengajar = dt.idTimPengajar WHERE dt.nip_nrp = $nip_nrp";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
    }
?>

