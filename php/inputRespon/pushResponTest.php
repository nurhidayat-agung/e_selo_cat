<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 8/14/2017
 * Time: 8:52 AM
 */

    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if(count($data) > 0)
    {
        $idUser = $data->idUser;
        $idBanksoal = $data->idBanksoal;
        $jenis = $data->jenis;
        $query = "INSERT INTO responTest(idUser, idBanksoal, jenis) VALUES ($idUser,$idBanksoal,'$jenis')";
        if(mysqli_query($conn, $query))
        {
            $foo = mysqli_insert_id($conn);
            echo $foo;
            mysqli_close($conn);
            exit;
        }
        else
        {
            echo 0;
            mysqli_close($conn);
            exit;
        }
    }

?>