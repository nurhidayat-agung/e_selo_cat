<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/3/2017
 * Time: 5:03 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if(count($data) > 0){
        $idTest = $data->idTest;
        $query = "SELECT * FROM detailtest AS dt INNER JOIN soaldetail AS sd ON dt.idSoal = sd.idSoal WHERE dt.idTest = $idTest";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }
?>