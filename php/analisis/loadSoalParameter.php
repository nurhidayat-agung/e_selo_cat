<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/18/2017
 * Time: 5:23 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $output = array();
        $query = "SELECT * FROM soaldetail WHERE idBankSoal = $idBankSoal";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        if (count($output) > 0){
            $postData = array(
                'status' => true,
                'message' => 'data soal ditemukan',
                'data' => $output
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }else{
            $postData = array(
                'status' => false,
                'message' => 'data soal tidak ditemukan'
        );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }
    }

?>