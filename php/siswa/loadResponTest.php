<?php

   //  include "../connection.php";
   //  $query = "SELECT * FROM respontest LEFT JOIN testing
			// ON respontest.idTest = testing.idTest
			// where nis = 12";
   //  $result = mysqli_query($conn, $query);
   //  while ($row = mysqli_fetch_assoc($result)){
   //      $output[] = $row;
   //  }
   //  echo json_encode($output);
   //  mysqli_close($conn);
   //  exit;

    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    if (count($data) > 0){
        $nis = $data->nis;
        $query = "SELECT * FROM respontest LEFT JOIN testing
			ON respontest.idTest = testing.idTest
			where nis = $nis";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)){
            $output[] = $row;
        }
        echo json_encode($output);
        mysqli_close($conn);
        exit;
    }
?>