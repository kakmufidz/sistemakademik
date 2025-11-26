<?php

function countTanggal($startDate, $endDate, $type = null)
{
    // Start in the format "YYYY-MM-DD"
    $startdate = date("Y-m-d", strtotime($startDate));
    $enddate = (!empty($endDate)) ? date("Y-m-d", strtotime($endDate)) : date("Y-m-d");
    // Create a DateTime object for the startdate
    $startDate = new DateTime($startdate);
    // Get the current date
    $endDate = new DateTime($enddate);
    // Calculate the interval between the startdate and the current date
    $countDate = $endDate->diff($startDate);
    // Access the "years" property of the $age object to get the age
    $years = $countDate->y;
    $months = $countDate->m;
    $days = $countDate->d;
    if ($type == "tahun") {
        return $years . " Tahun";
    } elseif ($type == "full") {
        return $years . " Tahun " . $months . " Bulan " . $days . " Hari";
    } else {
        return $countDate;
    }
}

function tgl_indo($tanggal)
{
    if (($tanggal == null) || ($tanggal == "0000-00-00")) {
        return "";
    }
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tgl_indo_jam($timestamp)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $hari = date('d', strtotime($timestamp));
    $bulanText = $bulan[(int)date('m', strtotime($timestamp))];
    $tahun = date('Y', strtotime($timestamp));
    $jam = date('H:i', strtotime($timestamp));

    return "{$hari} {$bulanText} {$tahun} Jam {$jam}";
}

function bulan_indo($bulan)
{
    $months = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    return $months[(int)$bulan]; // Output: November (jika dijalankan pada bulan November)
}

function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return  $hari_ini;
}

function waktu()
{
    date_default_timezone_set('Asia/Jakarta'); // Set zona waktu sesuai kebutuhan, contoh di sini adalah Asia/Jakarta

    $jam = date('G'); // Ambil jam dalam format 24 jam (0-23)

    if ($jam >= 5 && $jam < 12) {
        $waktu = "Pagi";
    } elseif ($jam >= 12 && $jam < 15) {
        $waktu = "Siang";
    } elseif ($jam >= 15 && $jam < 18) {
        $waktu = "Sore";
    } else {
        $waktu = "Malam";
    }

    return  $waktu;
}

function interval($dateString)
{
    // Ubah string tanggal menjadi objek DateTime
    $date = new DateTime($dateString);
    $now = new DateTime();

    // Hitung selisih waktu
    $interval = $now->diff($date);

    // Jika selisih lebih dari 1 jam
    if ($interval->h >= 1 || $interval->days > 0) {
        // Tampilkan dalam format 'tanggal bulan tahun jam'
        $waktu =  $date->format('d F Y H:i') . " WIB";
    } else {
        // Jika kurang dari 1 jam, tampilkan dalam format waktu berlalu
        if ($interval->i > 0) {
            $waktu =  $interval->i . ' menit yang lalu';
        } else {
            $waktu =  'Baru saja';
        }
    }
    return  $waktu;
}
