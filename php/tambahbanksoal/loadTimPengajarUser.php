<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 11:36 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $nip_nrp = $data->nip_nrp;
        $query = "SELECT t.idTimPengajar,t.namaTimPengajar FROM timpengajar AS t ".
            "INNER JOIN detailtimpengajar AS d ON t.idTimPengajar = d.idTimPengajar ".
            "WHERE d.nip_nrp = $nip_nrp AND d.posisi = 'ketua';";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
    }
?>