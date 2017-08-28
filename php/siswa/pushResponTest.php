 <?php  
 //insert.php
 include "../connection.php";
 $data = json_decode(file_get_contents("php://input"));  
 if(count($data) > 0)  
 {
     $idBankSoal = $data->idBankSoal;
     $idUser = $data->idUser;
     $query = "INSERT INTO responTest(idBanksoal,idUser,jenis) VALUES($idBankSoal,$idUser,'klasik')";
      if(mysqli_query($conn, $query))
      {
            $foo = mysqli_insert_id($conn);
            $cmd = "SELECT jml_soal FROM `banksoal` WHERE idBankSoal = $idBankSoal";
            $result = mysqli_query($conn, $cmd);
            while($row = mysqli_fetch_array($result))
            {
              $jml_soal = $row['jml_soal'];
            }

            $jOutput = array(
                'jml_soal' => $jml_soal,
                'idResponTest' => $foo
            );
            echo json_encode($jOutput);
            exit;
      }
      else
      {
            echo 'Error';
            exit;
      }
}  
 ?>