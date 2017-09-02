<?php
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idDetailTimPengajar = $data->idDetailTimPengajar;
        $query = "DELETE FROM detailtimpengajar WHERE idDetailTimPengajar = $idDetailTimPengajar";
        if(mysqli_query($conn, $query)) {
            return true;
            mysqli_close($conn);
            exit;
        }else
        {
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>