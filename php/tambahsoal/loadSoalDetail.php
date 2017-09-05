<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/7/2017
 * Time: 8:25 AM
 */

    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->idSoal)){
        $idSoal = $data->idSoal;
        $query = "SELECT * FROM `soaldetail` WHERE idSoal = $idSoal";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)){
            $output = $row;
        }

        if (count($output) > 0){
            $postData = array(
                'status'=> true,
                'message'=> 'data ditemukan',
                'data'=> $output
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }else{
            $postData = array(
                'status'=> false,
                'message'=> 'data tidak ditemukan'
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }
    }else{
        $postData = array(
            'status'=> false,
            'message'=> 'wrong method'
        );
        echo json_encode($postData);
        exit;
    }

?>