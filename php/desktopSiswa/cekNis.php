<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 9/14/2017
 * Time: 3:29 PM
 */
    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $output = array();
        $nis = $request->nis;
        $query = "SELECT * FROM siswa WHERE nis = $nis";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        if(count($output) > 0)
        {
            $postdata = array(
                'status' => 0,
                'messege' => 'nis sudah dipakai'
            );
            echo json_encode($postdata);
            mysqli_close($conn);
            exit;
        }
        else
        {
            $postdata = array(
                'status' => 1,
                'messege' => 'nis tersedia'
            );
            echo json_encode($postdata);
            mysqli_close($conn);
            exit;
        }

    }
?>