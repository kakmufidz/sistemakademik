<?php
function rupiah($angka)
{
  // Periksa apakah angka mengandung desimal
  if (is_float($angka) || strpos((string)$angka, '.') !== false) {
    // Format angka dengan dua desimal
    $hasil_format = number_format($angka, 2, ',', '.');
    // Hilangkan ",00" jika angka di belakang koma adalah 0
    $hasil_rupiah = rtrim(rtrim($hasil_format, '0'), ',');
  } else {
    // Jika angka bukan desimal, format tanpa angka di belakang koma
    $hasil_rupiah = number_format($angka, 0, ',', '.');
  }

  return "Rp. " . $hasil_rupiah;
}

function rp_count($angka)
{
  $hasil = number_format($angka, 0, '.', ',');
  return $hasil;
}
