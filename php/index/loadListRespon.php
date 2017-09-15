<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/29/2017
 * Time: 5:09 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $nip_nrp = $data->nip_nrp;
        $query = "SELECT s.nis,s.namaSiswa,t.namaTest,r.nilaiResponTest FROM respontest AS r ".
            "INNER JOIN siswa AS s ON r.nis = s.nis INNER JOIN testing AS t ON r.idTest = t.idTest ".
            "INNER JOIN banksoal AS b ON t.idBankSoal = b.idBankSoal INNER JOIN timpengajar AS tp ".
            "ON b.idTimPengajar = tp.idTimPengajar INNER JOIN detailtimpengajar AS dtp ON ".
            "tp.idTimPengajar = dtp.idTimPengajar INNER JOIN user AS u ON dtp.nip_nrp = u.nip_nrp ".
            "WHERE u.nip_nrp = $nip_nrp AND r.status = 'finish' ORDER BY r.idResponTest DESC limit 7";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }

?>