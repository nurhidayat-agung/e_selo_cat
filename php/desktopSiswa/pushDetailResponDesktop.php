<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/26/2017
 * Time: 10:26 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $count = 0;
        $idResponTest = $data->idResponTest;
        $idSoals = $data->idSoals;
        $crosceks = $data->crosceks;
        for ($a = 0; $a < count($idSoals); $a++){
            $query = "INSERT INTO detailrespon(idResponTest,idSoal,croscek) VALUES ($idResponTest,$idSoals[$a],$crosceks[$a])";
            if (mysqli_query($conn,$query)){
                $count ++;
            }
        }
        if($count == count($idSoals))
        {
            $postData = array(
                'status' => 1,
                'messege' => 'insert detail respon sukses',
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
                'messege' => 'insert detail gagal',
                'data' => null
            );
            echo json_encode($postData);
            mysqli_close($conn);
            exit;
        }
    }

?>