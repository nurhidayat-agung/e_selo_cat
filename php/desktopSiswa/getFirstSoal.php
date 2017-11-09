<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 30/10/17
 * Time: 12:45 ص
 */
include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data)>0){
    $idBankSoal = $data->idBankSoal;
    $jenisSoal = $data->jenisSoal;
    $output = null;
    $query = "select * from soaldetail WHERE idBankSoal = $idBankSoal ".
        "AND cluster = 1 and jenisSoal = '$jenisSoal' ORDER BY".
        " tingkatKesulitanSoal ASC limit 1";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        $output = $row;
    }
    if ($output != null){
        $postData = array(
            'status' => true,
            'messege' => 'soal ditemukan',
            'data' => $output
        );
        echo json_encode($postData,JSON_NUMERIC_CHECK);
        mysqli_close($conn);
        exit;
    }else{
        $postData = array(
            'status' => false,
            'messege' => 'soal tidak ditemukan',
            'data' => $output
        );
        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }
}

?>

