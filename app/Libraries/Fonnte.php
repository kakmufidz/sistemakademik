<?php

namespace App\Libraries;

use CURLFile;

class Fonnte
{
    protected $token;
    protected $baseUrl = 'https://api.fonnte.com/send';

    public function __construct()
    {
        // ambil token dari .env biar lebih aman
        $this->token = getenv('FONNTE_TOKEN');
    }


    /**
     * Helper kirim request ke API
     */
    protected function sendRequest($postFields)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $this->baseUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $this->token,
            ],
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return ['status' => false, 'error' => $error_msg];
        }

        curl_close($curl);
        return ['status' => true, 'response' => $response];
    }

    /**
     * Kirim pesan single
     */
    public function singleMessage($target, $message, $file = null, $countryCode = '62')
    {
        $postFields = [
            'target'      => $target,
            'message'     => $message,
            'countryCode' => $countryCode,
        ];

        if ($file) {
            $postFields['file'] = new CURLFile($file);
        }

        return $this->sendRequest($postFields);
    }

    /**
     * Kirim pesan bulk (banyak nomor atau banyak pesan)
     */
    public function bulkMessage($data, $defaultMessage = '', $delay = 2, $countryCode = '62')
    {
        if (isset($data[0]) && is_string($data[0])) {
            // pesan sama ke banyak nomor
            $targets = implode(',', $data);
            $postFields = [
                'target'      => $targets,
                'message'     => $defaultMessage, // bisa ubah sesuai kebutuhan
                'delay'       => $delay,
                'countryCode' => $countryCode,
            ];
        } else {
            // pesan berbeda ke tiap nomor
            $postFields = [
                'data' => json_encode($data),
            ];
        }

        return $this->sendRequest($postFields);
    }
}
