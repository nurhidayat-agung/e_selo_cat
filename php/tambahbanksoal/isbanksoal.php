<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/8/2017
 * Time: 11:13 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $count = 0;
        $namaBankSoal = $data->namaBankSoal;
        $nip_nrp = $data->nip_nrp;
        $query = "SELECT COUNT(*) as countBankSoal FROM banksoal AS b INNER JOIN timpengajar AS t ".
            "ON b.idTimPengajar = t.idTimPengajar INNER JOIN detailtimpengajar AS d ".
            "ON t.idTimPengajar = d.idTimPengajar WHERE b.namaBankSoal like '$namaBankSoal' AND d.nip_nrp = $nip_nrp";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $count = $row['countBankSoal'];
        }
        if ($count == 0){
            echo true;
            mysqli_close($conn);
            exit;
        }else{
            echo false;
            mysqli_close($conn);
            exit;
        }
    }

?>