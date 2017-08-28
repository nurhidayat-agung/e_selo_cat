<?php  
    //load_country.php
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    $idBanksoal = $data->idBanksoal;
    $query = "SELECT idSoal, isiSoal, pil1, pil2, pil3, pil4, kunci, dayaBeda, tingkatKesulitanSoal, cluster FROM soalDetail WHERE idBankSoal = 12 ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))  
    {  
        $output = $row;  
    }
    echo json_encode($output);
    exit;  
?> 