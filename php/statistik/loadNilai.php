<?php

    include "../connection.php";
    $query = "select * from respontest";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;
?>