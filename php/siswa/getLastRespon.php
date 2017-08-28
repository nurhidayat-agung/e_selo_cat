<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/29/2017
 * Time: 3:29 AM
 */
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idUser = $data->idUser;
        $query = "SELECT b.namaBankSoal,r.nilaiResponTest FROM respontest as r INNER JOIN banksoal AS b ON r.idBanksoal = b.idBankSoal WHERE r.idUser = $idUser AND r.STATUS = 'finish'";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }
?>