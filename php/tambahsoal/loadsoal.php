<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 7/16/2017
 * Time: 6:55 PM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
//    if ($data != null){
        if (isset($data->idBankSoal)){
            $idBankSoal = $data->idBankSoal;
            $output = array();
            $query = "SELECT * FROM `soaldetail` WHERE idBankSoal = $idBankSoal ORDER BY jenisSoal DESC";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result))
            {
                $output[] = $row;
            }
            if (count($output) > 0){
                $postData = array(
                    'status' => true,
                    'data' => $output
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }else{
                $postData = array(
                    'status' => false,
                    'message' => 'data tidak ditemukan'
                );
                echo json_encode($postData);
                mysqli_close($conn);
                exit;
            }
        }
?>