
<?php
include "../connection.php"
 $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $nik_nrp = $request->nik_nrp;
    $username = $request->username;
    $password = $request->password;
    $job = $request->job;
	$nama = $request->nama;
    $email = $request->email;


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO user (nik_nrp,username,password,job,nama,email)
VALUES ($nik_nrp, $username, $password, $job, $nama, $email)";

if ((mysqli_query($conn, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 mysqli_close($conn);
?>
