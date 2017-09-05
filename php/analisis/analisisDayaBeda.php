<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/23/2017
 * Time: 2:59 PM
 */
    include "../connection.php";
    include "functionAnalisisResponButir.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;

    }else{
        $postData = array(
            'status' => false,
            'message' => 'wrong method'
        );
        echo json_encode($postData);
        exit;
    }

?>