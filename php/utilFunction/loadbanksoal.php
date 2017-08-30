<?php
//load_state.php
    include "../connection.php";
    $output = array();
    $data = json_decode(file_get_contents("php://input"));
    $query = "SELECT * FROM banksoal";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        $output[] = $row;
    }
    echo json_encode($output);
?>