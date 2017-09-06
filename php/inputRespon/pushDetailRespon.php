<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/14/2017
 * Time: 10:31 AM
 */
    include "../connection.php";
    $data_in = (array)json_decode(trim(file_get_contents('php://input')));
    $flag = 0;
    if(count($data_in > 0)){
        $count = $data_in['jumlah'];
        for($a = 0; $a < $count; $a++){
            $idResponTest = $data_in['idResponTest'];
            $idSoal = $data_in['idSoal'][$a];
            $jawab = $data_in['jawab'][$a];
            $croscek = $data_in['croscek'][$a];
            $query = "INSERT INTO detailrespon(idResponTest, idSoal, jawab, croscek) VALUES ($idResponTest, $idSoal,'$jawab', '$croscek')";
            if(mysqli_query($conn, $query))
            {
                $flag ++;
            }
        }
        if($flag == $count){
            echo true;
            mysqli_close($conn);
            exit;
        }else {
            echo false;
            mysqli_close($conn);
            exit;
        }
    }

?>