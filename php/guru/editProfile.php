<?php

    include "../connection.php";
    
    $nip_nrp = $_POST['nip_nrp'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

        $query = "UPDATE user SET nip_nrp=$nip_nrp, password='$password', nama='$nama', email='$email' WHERE nip_nrp = $nip_nrp";
        if(mysqli_query($conn, $query))
        {   
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('edit Profile BERHASIL, silahkan login kembali')
            window.location.href='../../logoutAdmin.php';
            </SCRIPT>");
            exit;
        }
        else
        {
            echo false;
            mysqli_close($conn);
            exit;
        }
?>

