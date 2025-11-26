<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;

class GuzzleApi
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
        $this->apiUrl = env('ACCURATE_API_URL_HJA');
        $this->apiPublicUrl = env('ACCURATE_API_PUBLIC_URL_HJA');
        $this->accessToken = env('ACCURATE_ACCESS_TOKEN_HJA');
        $this->clientId = env('ACCURATE_CLIENT_ID_HJA');
        $this->clientSecret = env('ACCURATE_CLIENT_SECRET_HJA');
        $signatureSecret = env('ACCURATE_SIGNATURE_SECRET_HJA');
        // Membuat DateTime dengan zona waktu Asia/Jakarta
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));

        // Sinkronkan dengan server NTP (opsional jika masih ada perbedaan waktu)
        $dateTime->setTimestamp(time());

        $this->timestamp = $dateTime->format('Y-m-d\TH:i:sP');

        // Membuat X-Api-Signature
        $this->signature = $this->generateApiSignature($this->timestamp, $signatureSecret);

        $this->headers = [
            'Authorization'   => 'Bearer ' . $this->accessToken,
            'Content-Type'    => 'application/json',
            'X-Api-Timestamp' => $this->timestamp,
            'X-Api-Signature' => $this->signature,
        ];
    }

    private function generateApiSignature($timestamp, $clientSecret)
    {
        $hash = hash_hmac('sha256', $timestamp, $clientSecret, true);
        return base64_encode($hash);
    }

    public function get($url, $params = [])
    {
        $customUrl = $this->apiPublicUrl . $url;
        $client = new Client();

        try {
            $response = $client->get($customUrl, [
                'headers' => $this->headers,
                'query'   => $params,
            ]);
            return [
                'status' => $response->getStatusCode(),
                'data'   => json_decode($response->getBody()->getContents(), true),
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 500,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getTest($url, $params = [])
    {
        $customUrl = $this->apiPublicUrl . $url;
        $client = new Client();

        try {
            $response = $client->get($customUrl, [
                'headers' => $this->headers,
                'query'   => $params,
            ]);
            return [
                'status' => $response->getStatusCode(),
                'data'   => json_decode($response->getBody()->getContents(), true),
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 500,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function post($url, $params = [])
    {
        $client = new Client();
        $customUrl = $this->apiPublicUrl . $url;

        try {
            $response = $client->post($customUrl, [
                'headers' => $this->headers,
                'json'    => $params,
            ]);

            return [
                'status' => $response->getStatusCode(),
                'data'   => json_decode($response->getBody()->getContents(), true),
            ];
        } catch (\Exception $e) {
            return [
                'status'  => 500,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function parallelGet($url, $paramsList)
    {
        $customUrl = $this->apiPublicUrl . $url;
        $client = new \GuzzleHttp\Client();
        $results = [];
        $rateLimitDelay = intval(1e6 / 8); // 1 detik dibagi 8 request = 125000 mikrodetik (125ms)
        $concurrency = 7; // Maksimal 7 permintaan paralel sesuai aturan Accurate API

        // Fungsi generator untuk membuat request berdasarkan parameter
        $requests = function ($paramsList) use ($customUrl, $rateLimitDelay) {
            foreach ($paramsList as $params) {
                $queryString = http_build_query($params);

                // Tambahkan delay untuk menghormati rate limit Accurate API
                usleep($rateLimitDelay);

                // Buat request
                yield new \GuzzleHttp\Psr7\Request('GET', "$customUrl?$queryString", $this->headers);
            }
        };

        $pool = new \GuzzleHttp\Pool($client, $requests($paramsList), [
            'concurrency' => $concurrency, // Maksimal 7 permintaan paralel
            'fulfilled' => function ($response) use (&$results) {
                // Tambahkan hasil sukses ke array
                $data = json_decode($response->getBody()->getContents(), true);
                if (isset($data['d']) && is_array($data['d'])) {
                    $results = array_merge($results, $data['d']);
                }
            },
            'rejected' => function ($reason) {
                // Log error jika ada
                log_message('error', $reason->getMessage());
            },
        ]);

        // Tunggu semua permintaan selesai
        $promise = $pool->promise();
        $promise->wait();

        return $results;
    }

    // public function parallelGet2($url, $paramsList, $concurrency = 7)
    // {
    //     $customUrl = $this->apiPublicUrl . $url;
    //     $client = new \GuzzleHttp\Client();
    //     $results = [];
    //     $rateLimitDelay = 142857; // 1 detik dibagi 7 request = 142.857 mikrodetik

    //     // Fungsi generator untuk membuat request berdasarkan parameter
    //     $requests = function ($paramsList) use ($customUrl, $rateLimitDelay, $client) {
    //         foreach ($paramsList as $params) {
    //             $queryString = http_build_query($params);
    //             usleep($rateLimitDelay); // Tambahkan jeda antar request
    //             yield function () use ($client, $customUrl, $queryString) {
    //                 return $client->requestAsync('GET', "$customUrl?$queryString", [
    //                     'headers' => $this->headers,
    //                 ]);
    //             };
    //         }
    //     };

    //     $pool = new \GuzzleHttp\Pool($client, $requests($paramsList), [
    //         'concurrency' => $concurrency, // Maksimal 7 proses paralel
    //         'fulfilled' => function ($response) use (&$results) {
    //             // Tambahkan hasil sukses ke array
    //             $data = json_decode($response->getBody()->getContents(), true);
    //             if (isset($data['d']) && is_array($data['d'])) {
    //                 $results[] = $data['d'];
    //             }
    //         },
    //         'rejected' => function ($reason) {
    //             // Log error jika ada
    //             log_message('error', $reason->getMessage());
    //         },
    //     ]);

    //     // Tunggu semua permintaan selesai
    //     $promise = $pool->promise();
    //     $promise->wait();

    //     return $results;
    // }

    public function parallelGet2($url, $paramsList, $concurrency = 7)
    {
        $customUrl = $this->apiPublicUrl . $url;
        $client = new \GuzzleHttp\Client();
        $results = [];
        $rateLimitDelay = 142857; // 1 detik dibagi 7 request = 142.857 mikrodetik

        // Fungsi generator untuk membuat request berdasarkan parameter
        $requests = function ($paramsList) use ($customUrl, $rateLimitDelay, $client) {
            foreach ($paramsList as $params) {
                $queryString = http_build_query($params);
                usleep($rateLimitDelay); // Tambahkan jeda antar request
                yield function () use ($client, $customUrl, $queryString) {
                    return $client->requestAsync('GET', "$customUrl?$queryString", [
                        'headers' => $this->headers,
                    ]);
                };
            }
        };

        $pool = new \GuzzleHttp\Pool($client, $requests($paramsList), [
            'concurrency' => $concurrency, // Maksimal 7 proses paralel
            'fulfilled' => function ($response) use (&$results) {
                // Tambahkan hasil sukses ke array
                $data = json_decode($response->getBody()->getContents(), true);
                if (isset($data['d']) && is_array($data['d'])) {
                    $results[] = $data['d'];
                }
            },
            'rejected' => function ($reason) {
                // Log error jika ada
                log_message('error', $reason->getMessage());
            },
        ]);

        // Tunggu semua permintaan selesai
        $promise = $pool->promise();
        $promise->wait();

        return $results;
    }
}
