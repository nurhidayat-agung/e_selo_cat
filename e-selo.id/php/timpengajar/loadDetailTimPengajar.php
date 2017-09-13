<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/2/2017
 * Time: 5:41 AM
 */
    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0) {
        $idTimPengajar = $request->idTimPengajar;
        $query = "SELECT idDetailTimPengajar,d.nip_nrp AS nip_nrp,posisi,u.nama FROM detailtimpengajar as d INNER JOIN user AS u ".
            "ON d.nip_nrp = u.nip_nrp WHERE d.idTimPengajar = $idTimPengajar";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }
?>