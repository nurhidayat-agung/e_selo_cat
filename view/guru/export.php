<?php

  // memanggil class PHPExcel
  require_once __DIR__.'../library/PHPExcel-1.8/Classes/PHPExcel.php';

  // object excel
  $excel = new PHPExcel();
  $excel->setActiveSheetIndex(0);
  $sheet = $excel->getActiveSheet()->setTitle('data');

  // set title kolom
  $sheet->setCellValue('A1', 'NAMA');
  $sheet->setCellValue('B1', 'ALAMAT');

  // menampilkan data users
  $request = json_decode( file_get_contents('php://input') );
  $variable = $request->data;
  echo print_r($variable);
  //$sql = 'SELECT * FROM users';
  //$rs = mysql_query($sql) or die ($sql);

  // $i = 2;
  // while ($row = mysql_fetch_array($variable)) {
  //   $nama = $row['nama'];
  //   $alamat = $row['alamat'];

  //   // buat baris dam kolom pada excel
  //   // isi kolom A
  //   $sheet->setCellValue('A'.$i, $nama);

  //   // isi kolom B
  //   $sheet->setCellValue('B'.$i, $alamat);

  //   $i++;
  // }

  // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  // header('Content-Disposition: attachment;filename="users.xlsx"');
  // $data = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
  // $data->save('php://output');
  exit;
