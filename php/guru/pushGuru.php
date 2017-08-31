<?php

    include "../connection.php";
    $request = json_decode(file_get_contents("php://input"));
    if (count($request) > 0){
        $nip_nrp = $request->nip_nrp;
        $username = $request->username;
        $password = $request->password;
        $job = $request->job;
        $nama = $request->nama;
        $email = $request->email;

        $query = "INSERT INTO user (nip_nrp,username,password,job,nama,email)
                    VALUES ('$nip_nrp', '$username', '$password', '$job', '$nama', '$email')";
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
