<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/29/2017
 * Time: 4:19 AM
 */
    include "../connection.php";
    $query = "SELECT b.namaBankSoal,b.jml_soal,m.namaMapel FROM banksoal AS b ".
        "INNER JOIN mapel AS m ON b.idMapel = m.idMapel ORDER BY b.idBankSoal DESC limit 7";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;
?>