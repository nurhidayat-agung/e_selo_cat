 <?php  
 //insert.php
 include "../connection.php";
 $data = json_decode(file_get_contents("php://input"));  
 if(count($data) > 0)  
 {
      $namaMapel = mysqli_real_escape_string($conn, $data->namaMapel);
      $deskripsiMapel = mysqli_real_escape_string($conn, $data->deskripsiMapel);
      $query = "INSERT INTO mapel(namaMapel, deskripsiMapel) VALUES ('$namaMapel', '$deskripsiMapel')";
      if(mysqli_query($conn, $query))
      {  
//        $foo = mysqli_insert_id($connect);
//        echo 'data berhasil dimasukan dengan id '.$foo;
          echo true;
      }  
      else
      {  
        echo false;
      }
      mysqli_close($conn);
 }  
 ?>