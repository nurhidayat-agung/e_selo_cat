<?php

    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $nip_nrp = $request->nip_nrp;
        $password = $request->password;
        $job = $request->job;
        $nama = $request->nama;
        $email = $request->email;
        $query = "UPDATE user SET nip_nrp=$nip_nrp, password='$password', job='$job', nama='$nama', email='$email' WHERE nip_nrp = $nip_nrp";
        if(mysqli_query($conn, $query))
        {
            echo true;
            mysqli_close($conn);
            exit;
        }
        else
        {
            echo false;
            mysqli_close($conn);
            exit;
        }
    }
?>

