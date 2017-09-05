<?php

    include "../connection.php";
    $query = "SELECT * FROM siswa LEFT JOIN angkatansiswa
			ON angkatansiswa.idAngkatan = siswa.idAngkatan
			LEFT JOIN pletonsiswa
			ON pletonsiswa.idPleton = siswa.idPleton";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;
?>