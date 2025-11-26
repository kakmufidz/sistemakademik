<?php
// Mengubah array menjadi satu array PHP dalam format string
function formatArray($array)
{
    $output = "";
    $chunks = array_chunk($array, 10); // Bagi array menjadi potongan berisi 10 elemen
    foreach ($chunks as $chunk) {
        $output .= implode(', ', $chunk) . ",\n    ";
    }
    $output = rtrim($output, ",\n    ");
    return $output;
}

// membuat kode random
function generateRandomCode($length = 6)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomCode = '';
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomCode;
}

// compres gambar
function compressImage($source, $destination, $quality = 75)
{
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $destination, $quality);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);

        // Konversi PNG ke JPEG agar bisa dikompresi lebih baik
        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255)); // background putih
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
        imagejpeg($bg, $destination, $quality);

        imagedestroy($image);
        imagedestroy($bg);
    }
}

function urlaktif()
{
    $currentURL = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $urlaktif = explode('/', $currentURL);
    return $urlaktif;
}

function getNotEmptyFields($post)
{
    return array_keys(array_filter($post, fn($v) => !empty($v)));
}

function excerpt($html, $limit = 5)
{
    // Ganti <br>, </p>, </div>, dll dengan spasi
    $html = preg_replace('/<br\s*\/?>/i', ' ', $html);
    $html = preg_replace('/<\/(p|div|h[1-6]|li)>/i', ' ', $html);

    // Hilangkan semua tag HTML lainnya
    $plainText = strip_tags($html);

    // Bersihkan spasi ganda
    $plainText = trim(preg_replace('/\s+/', ' ', $plainText));

    // Potong jadi 5 kata pertama
    $words = explode(" ", $plainText);
    $firstWords = implode(" ", array_slice($words, 0, $limit));

    return $firstWords . '...';
}
