<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Webhook extends BaseController
{
    public function absensi()
    {
        // Ambil API key dari header
        $apiKey = $this->request->getHeaderLine('X-API-KEY');
        $expectedKey = getenv('WEBHOOK_SECRET');

        // Validasi API key
        if ($apiKey !== $expectedKey) {
            return $this->response->setStatusCode(403)->setBody('Forbidden: Invalid API Key');
        }

        // Ambil body data
        $body = file_get_contents('php://input');

        // Simpan ke file log
        $file = WRITEPATH . 'logs/absensi_webhook.txt';
        file_put_contents($file, $body . "\n", FILE_APPEND);

        return $this->response->setStatusCode(200)->setBody('OK');
    }
}
