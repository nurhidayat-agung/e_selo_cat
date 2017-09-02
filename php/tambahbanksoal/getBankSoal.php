<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/30/2017
 * Time: 4:13 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idUser = $data->idUser;
        $query = "SELECT b.idBankSoal,b.idTimPengajar,b.namaBankSoal,b.deskripsiBankSoal,t.namaTimPengajar,d.posisi FROM banksoal ".
            "AS b INNER JOIN timpengajar AS t ON b.idTimPengajar = t.idTimPengajar ".
            "INNER JOIN detailtimpengajar AS d ON t.idTimPengajar = d.idTimPengajar WHERE d.nip_nrp = $idUser";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
    }
?>