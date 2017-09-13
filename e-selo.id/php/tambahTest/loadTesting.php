<?php

    include "../connection.php";
    $query = "SELECT * FROM testing LEFT JOIN banksoal
			ON testing.idBankSoal = = banksoal.idBankSoal
			LEFT JOIN timpengajar
			ON banksoal.idTimPengajar = timpengajar.idTimPengajar";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;
?>