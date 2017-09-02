<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 5:15 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $pilgan = 0;
        $essay = 0;
        $query = "SELECT COUNT(*) AS jmlPilGan FROM soaldetail as s INNER JOIN banksoal AS b "
            ."ON s.idBankSoal = b.idBankSoal WHERE b.idBankSoal = $idBankSoal AND s.jenisSoal = 'Pilihan Ganda';";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $pilgan = $row['jmlPilGan'];
        }
        $query2 = "SELECT COUNT(*) AS jmlEssay FROM soaldetail as s INNER JOIN banksoal AS b "
            ."ON s.idBankSoal = b.idBankSoal WHERE b.idBankSoal = $idBankSoal AND s.jenisSoal = 'Melengkapi';";
        $result2 = mysqli_query($conn,$query2);
        while ($row = mysqli_fetch_assoc($result2)){
            $essay = $row['jmlEssay'];
        }
        $postData = array(
            'jmlPilGan'=>$pilgan,
            'jmlEssay'=>$essay
        );
        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }
?>