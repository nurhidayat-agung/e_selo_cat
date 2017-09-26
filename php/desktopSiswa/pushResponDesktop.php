<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/4/2017
 * Time: 2:25 AM
 */
include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    $nis = $data->nis;
    $idTest = $data->idTest;
    $nilai = $data->nilai;
    $jenis = $data->jenis;
    $query = "INSERT INTO respontest(nis,idTest,nilaiResponTest,jenis,status) VALUES ($nis,$idTest,$nilai,'$jenis','finish')";
    if(mysqli_query($conn, $query))
    {
        $idRespon = mysqli_insert_id($conn);
        $postData = array(
            'status' => 1,
            'messege' => $idRespon,
            'data' => null
        );
        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }
    else
    {
        $postData = array(
            'status' => 0,
            'messege' => 'insert respon gagal',
            'data' => null
        );
        echo json_encode($postData);
        mysqli_close($conn);
        exit;
    }

}
?>