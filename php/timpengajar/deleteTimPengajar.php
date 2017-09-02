<?php

include "../connection.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
    $idTimPengajar = $data->idTimPengajar;
    $query = "DELETE FROM detailtimpengajar WHERE idTimPengajar= $idTimPengajar";
    if(mysqli_query($conn, $query))
    {
        $query2 = "DELETE FROM timpengajar WHERE idTimPengajar= $idTimPengajar";
        if (mysqli_query($conn,$query2)){
            return true;
            mysqli_close($conn);
            exit;
        }else{
            return false;
            mysqli_close($conn);
            exit;
        }
    }
    else
    {
        echo false;
        mysqli_close($conn);
        exit;
    }
}
?>