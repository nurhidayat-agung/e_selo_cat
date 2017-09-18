<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/16/2017
 * Time: 6:27 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if(count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $query = "SELECT * FROM soaldetail AS sd INNER JOIN banksoal AS b ".
            "ON sd.idBankSoal = b.idBankSoal WHERE sd.idBankSoal = $idBankSoal ".
            "order by sd.jenisSoal desc";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }
?>