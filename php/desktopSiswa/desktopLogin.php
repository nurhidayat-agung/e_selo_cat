<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/14/2017
 * Time: 4:56 PM
 */
    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $output = '';
        $nis = $request->nis;
        $password = $request->password;
        $query = "SELECT * FROM siswa AS s INNER JOIN kompisiswa AS k on s.idKompi = k.idKompi ".
            "INNER JOIN pletonsiswa as p on s.idPleton = p.idPleton INNER JOIN angkatansiswa AS a ".
            "on s.idAngkatan = a.idAngkatan WHERE nis = $nis AND password = $password";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output = $row;
        }
        if($output == '')
        {
            $postdata = array(
                'status' => 0,
                'messege' => 'login gagal'
            );
            echo json_encode($postdata);
            mysqli_close($conn);
            exit;
        }
        else
        {
            $postdata = array(
                'status' => 1,
                'messege' => 'login berhasil',
                'data' => $output
            );
            echo json_encode($postdata);
            mysqli_close($conn);
            exit;
        }
    }

?>