<?php

namespace App\Libraries;

use CodeIgniter\HTTP\ResponseInterface;

class AccurateApiServiceHM
{
    private $apiUrl;
    private $apiPublicUrl;
    private $accessToken;
    private $clientId;
    private $clientSecret;
    private $timestamp;
    private $signature;
    private $headers;

    public function __construct()
    {
        // Mengambil data dari .env
        $this->apiUrl = getenv('ACCURATE_API_URL_HM');
        $this->apiPublicUrl = getenv('ACCURATE_API_PUBLIC_URL_HM');
        $this->accessToken = getenv('ACCURATE_ACCESS_TOKEN_HM');
        $this->clientId = getenv('ACCURATE_CLIENT_ID_HM');
        $this->clientSecret = getenv('ACCURATE_CLIENT_SECRET_HM');
        $signatureSecret = getenv('ACCURATE_SIGNATURE_SECRET_HM');

        // Membuat DateTime dengan zona waktu Asia/Jakarta
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));

        // Format ISO 8601 dengan offset zona waktu (misalnya: 2024-09-06T11:42:47+07:00)
        $this->timestamp = $dateTime->format('Y-m-d\TH:i:sP');

        // Membuat X-Api-Signature dengan HMAC-SHA256 dan Signature Secret sebagai key
        $this->signature = $this->generateApiSignature($this->timestamp, $signatureSecret);

        $this->headers = [
            'Authorization: Bearer ' . $this->accessToken,
            'Content-Type: application/json',
            'X-Api-Timestamp: ' . $this->timestamp,
            'X-Api-Signature: ' . $this->signature
        ];
    }

    public function requestApiToken()
    {
        // Inisiasi cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . "api-token.do");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch); // Mendapatkan error dari cURL jika ada
        curl_close($ch);

        // Debugging jika ada kesalahan pada cURL
        if ($curlError) {
            return [
                'status' => 'error',
                'message' => 'cURL error: ' . $curlError
            ];
        }

        if ($httpCode !== ResponseInterface::HTTP_OK) {
            return [
                'status' => 'error',
                'message' => 'HTTP error: ' . $httpCode,
                'response' => $response
            ];
        }

        // Mengembalikan hasil response jika berhasil
        return json_decode($response, true);
    }

    private function generateApiSignature($timestamp, $clientSecret)
    {
        // Membuat HMAC-SHA256 dari timestamp menggunakan clientSecret sebagai key
        $hash = hash_hmac('sha256', $timestamp, $clientSecret, true);

        // Encode hasil hash ke Base64
        return base64_encode($hash);
    }

    public function get($url, $params)
    {
        // URL untuk mengambil data
        $customUrl = $this->apiPublicUrl . $url;

        // Inisiasi cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,  $customUrl . '?' . http_build_query($params));
        // $test = curl_setopt($ch, CURLOPT_URL,  $customUrl . '?' . http_build_query($params));
        // var_dump($customUrl . '?' . http_build_query($params));
        // die;
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch); // Mendapatkan error dari cURL jika ada
        curl_close($ch);

        // Debugging jika ada kesalahan pada cURL
        if ($curlError) {
            return [
                'status' => 'error',
                'message' => 'cURL error: ' . $curlError
            ];
        }

        if ($httpCode !== ResponseInterface::HTTP_OK) {
            return [
                'status' => 'error',
                'message' => 'HTTP error: ' . $httpCode,
                'response' => $response
            ];
        }

        // Mengembalikan hasil response jika berhasil
        return json_decode($response, true);
    }
}
