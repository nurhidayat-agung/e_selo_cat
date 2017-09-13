<?php

    include "../connection.php";
    $query = "SELECT * FROM respontest LEFT JOIN testing
    ON respontest.idTest = testing.idTest
    LEFT JOIN siswa 
    ON respontest.nis = siswa.nis
    LEFT JOIN pletonsiswa
    ON siswa.idPleton = pletonsiswa.idPleton
    LEFT JOIN angkatansiswa
    ON siswa.idAngkatan = angkatansiswa.idAngkatan
    LEFT JOIN banksoal
    ON banksoal.idBankSoal = testing.idBankSoal
    LEFT JOIN kompisiswa
    ON siswa.idKompi = kompisiswa.idKompi
    ORDER BY siswa.nis";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)){
        $output[] = $row;
    }
    echo json_encode($output);
    mysqli_close($conn);
    exit;

  /*  include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $idBankSoal = $data->idBankSoal;
        $idPleton = $data->idPleton;
        $namaKompi = $data->namaKompi;
        $idAngkatan = $data->idAngkatan;
        $query = "SELECT * FROM respontest LEFT JOIN testing
                ON respontest.idTest = testing.idTest
                LEFT JOIN siswa 
                ON respontest.nis = siswa.nis
                LEFT JOIN pletonsiswa
                ON siswa.idPleton = pletonsiswa.idPleton
                LEFT JOIN angkatansiswa
                ON siswa.idAngkatan = angkatansiswa.idAngkatan
                LEFT JOIN banksoal
                ON banksoal.idBankSoal = testing.idBankSoal
                WHERE banksoal.idBankSoal = $idBankSoal AND pletonsiswa.idPleton = $idPleton
                AND angkatansiswa.idAngkatan = $idAngkatan AND siswa.namaKompi = 'A'
                ORDER BY siswa.nis";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }*/
?>