<?php

require FCPATH . '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Data Karyawan PT. Harapan Jaya Globalindo')
  ->setCellValue('A2', 'Kantor')
  ->setCellValue('C2', ': ' . ucfirst(strtolower($kantor)))
  ->setCellValue('A3', 'Kategori')
  ->setCellValue('C3', ': ' . ucfirst(strtolower($kategori)))
  ->setCellValue('A4', 'Per Tanggal')
  ->setCellValue('C4', ': ' . tgl_indo(date("Y-m-d")));
$sheet->mergeCells('A1:C1');
$sheet->mergeCells('A2:B2');
$sheet->mergeCells('A3:B3');
$sheet->mergeCells('A4:B4');
$sheet->getStyle('A1:C4')->getAlignment()
  ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP)
  ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

$sheet->setCellValue('A6', 'No')
  ->setCellValue('B6', 'NUK')
  ->setCellValue('C6', 'NAMA')
  ->setCellValue('D6', 'DEPARTMENT')
  ->setCellValue('E6', 'POSISI/JABATAN')
  ->setCellValue('F6', 'TEMPAT LAHIR')
  ->setCellValue('G6', 'TANGGAL LAHIR')
  ->setCellValue('H6', 'JENIS KELAMIN')
  ->setCellValue('I6', 'GOL. DARAH')
  ->setCellValue('J6', 'NIK')
  ->setCellValue('K6', 'ALAMAT')
  ->setCellValue('L6', 'AGAMA')
  ->setCellValue('M6', 'STATUS PERKAWINAN')
  ->setCellValue('N6', 'NOMOR TELPON')
  ->setCellValue('O6', 'BPJS')
  ->setCellValue('P6', 'JHT')
  ->setCellValue('Q6', 'NO. REKENING MANDIRI')
  ->setCellValue('R6', 'EMAIL')
  ->setCellValue('S6', 'NPWP')
  ->setCellValue('T6', 'STATUS KARYAWAN')
  ->setCellValue('U6', 'TANGGAL MASUK')
  ->setCellValue('V6', 'MASA KERJA')
  ->setCellValue('W6', 'TANGGAL AWAL KONTRAK')
  ->setCellValue('X6', 'TANGGAL AKHIR KONTRAK');
$sheet = $spreadsheet->getActiveSheet();
foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
  $sheet->getColumnDimension($col)->setAutoSize(true);
}

$sheet->getStyle('1:6')->getFont()->setBold(true);
$sheet->getStyle('6')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$no = 1;
$i = 1;
$row = 7;
foreach ($datakaryawan as $karyawan) {
  $nama = $karyawan['user_nama_depan'] . " " . $karyawan['user_nama_belakang'];
  $usia = countTanggal($karyawan["birthday"], null, "tahun");
  $resign_date = ((empty($karyawan['resign_date'])) || ($karyawan['resign_date'] == "0000-00-00")) ? date("Y-m-d") : $karyawan['resign_date'];
  $masakerja = countTanggal($karyawan["reg_date"], $resign_date, "full");
  $jenis_kelamin = ($karyawan["jk"] == 1) ? "Laki-laki" : "Perempuan";
  if ($karyawan['user_status'] == 0) {
    $status_karyawan = "Resign";
  } elseif ($karyawan['user_status'] == 1) {
    $status_karyawan = "Tetap";
  } elseif ($karyawan['user_status'] == 2) {
    $status_karyawan = "Kontrak";
  } elseif ($karyawan['user_status'] == 3) {
    $status_karyawan = "Training";
  }

  $resign_date = ((empty($karyawan['resign_date'])) || ($karyawan['resign_date'] == "0000-00-00")) ? date("Y-m-d") : $karyawan['resign_date'];
  $masakerja = countTanggal($karyawan["reg_date"], $resign_date, "full");

  // Setting Nomor
  $col_no = "A" . $row;
  $sheet->setCellValue($col_no, $i);
  $sheet->getStyle($col_no)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
  $sheet->getStyle($col_no)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
  // End Setting Nomor

  // NUK
  $col_nuk = "B" . $row;
  $sheet->setCellValue($col_nuk, $karyawan['usernuk']);
  // End NUK

  // Nama
  $col_nama = "C" . $row;
  $sheet->setCellValue($col_nama, $nama);
  // End Nama

  // Department
  $col_nama_department = "D" . $row;
  $sheet->setCellValue($col_nama_department, $karyawan["nama_department"]);
  // End Department

  // Nama jabatan
  $col_jabatan = "E" . $row;
  $sheet->setCellValue($col_jabatan, $karyawan["jabatan"]);
  // End Nama jabatan

  // tempat_lahir
  $col_tempat_lahir = "F" . $row;
  $sheet->setCellValue($col_tempat_lahir, $karyawan["tmpat_lahir"]);
  // End tempat_lahir

  // tanggal_lahir
  $col_tanggal_lahir = "G" . $row;
  $sheet->setCellValue($col_tanggal_lahir, tgl_indo($karyawan["birthday"]));
  // End tanggal_lahir

  // jenis_kelamin
  $col_jenis_kelamin = "H" . $row;
  $sheet->setCellValue($col_jenis_kelamin, $jenis_kelamin);
  // End jenis_kelamin

  // golongan_darah
  $col_golongan_darah = "I" . $row;
  $sheet->setCellValue($col_golongan_darah, $karyawan["golda"]);
  // End golongan_darah

  // nik
  $col_nik = "J" . $row;
  $sheet->setCellValueExplicit($col_nik, $karyawan["nik"], DataType::TYPE_STRING);
  // End nik

  // alamat
  $col_alamat = "K" . $row;
  $sheet->setCellValue($col_alamat, $karyawan["alamat"]);
  // End alamat

  // agama
  $col_agama = "L" . $row;
  $sheet->setCellValue($col_agama, $karyawan["agama"]);
  // End agama

  // status_perkawinan
  $col_status_perkawinan = "M" . $row;
  $sheet->setCellValue($col_status_perkawinan, $karyawan["status_perkawinan"]);
  // End status_perkawinan

  // telphone
  $col_telphone = "N" . $row;
  $sheet->setCellValueExplicit($col_telphone, $karyawan["no_telp"], DataType::TYPE_STRING);
  // End telphone

  // bpjs
  $col_bpjs = "O" . $row;
  $sheet->setCellValueExplicit($col_bpjs, $karyawan["no_bpjs"], DataType::TYPE_STRING);
  // End bpjs

  // jht
  $col_jht = "P" . $row;
  $sheet->setCellValueExplicit($col_jht, $karyawan["no_jht"], DataType::TYPE_STRING);
  // End jht

  // rekening
  $col_rekening = "Q" . $row;
  $sheet->setCellValueExplicit($col_rekening, $karyawan["no_rek"], DataType::TYPE_STRING);
  // End rekening

  // email
  $col_email = "R" . $row;
  $sheet->setCellValue($col_email, $karyawan["email"]);
  // End email

  // npwp
  $col_npwp = "S" . $row;
  $sheet->setCellValueExplicit($col_npwp, $karyawan["npwp"], DataType::TYPE_STRING);
  // End npwp

  // status_karyawan
  $col_status_karyawan = "T" . $row;
  $sheet->setCellValue($col_status_karyawan, "Karyawan " . $status_karyawan);
  // End status_karyawan

  // tanggal_mulai
  $col_tanggal_mulai = "U" . $row;
  $sheet->setCellValue($col_tanggal_mulai, tgl_indo($karyawan["reg_date"]));
  // End tanggal_mulai

  // masa_kerja
  $col_masa_kerja = "V" . $row;
  $sheet->setCellValue($col_masa_kerja, $masakerja);
  // End masa_kerja

  // tanggal_mulai
  $col_tanggal_mulai = "W" . $row;
  $sheet->setCellValue($col_tanggal_mulai, tgl_indo($karyawan["ka_mulai"]));
  // End tanggal_mulai

  // tanggal_akhir
  $col_tanggal_akhir = "X" . $row;
  $sheet->setCellValue($col_tanggal_akhir, tgl_indo($karyawan["ka_akhir"]));
  // End tanggal_akhir

  $i++;
  $row++;
}

$filename = "Data Karyawan " . date('dmY_His') . ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;
