<?php

namespace App\Controllers;

class Dokumen extends BaseController
{
    function __construct()
    {
        $this->session = session();
    }

    public function docview($kantor, $act, $filename)
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }

        // Ambil nilai act
        if ($act == "kontrak") {
            $path = WRITEPATH . 'uploads/dokumen_kontrak_' . $kantor . '/' . $filename;
        } elseif ($act == "evaluasi") {
            $path = WRITEPATH . 'uploads/dokumen_evaluasi_kontrak_' . $kantor . '/' . $filename;
        } elseif ($act == "pelatihan") {
            $path = WRITEPATH . 'uploads/dokumen_pelatihan_' . $kantor . '/' . $filename;
        } elseif ($act == "dokumen") {
            $path = WRITEPATH . 'uploads/dokumen_' . $kantor . '/' . $filename;
        }

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mime = mime_content_type($path);

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody(file_get_contents($path));
    }

    public function docload($kantor, $act, $filename)
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        // Ambil nilai act
        if ($act == "kontrak") {
            $path = WRITEPATH . 'uploads/dokumen_kontrak_' . $kantor . '/' . $filename;
        } elseif ($act == "evaluasi") {
            $path = WRITEPATH . 'uploads/dokumen_evaluasi_kontrak_' . $kantor . '/' . $filename;
        } elseif ($act == "pelatihan") {
            $path = WRITEPATH . 'uploads/dokumen_pelatihan_' . $kantor . '/' . $filename;
        } elseif ($act == "dokumen") {
            $path = WRITEPATH . 'uploads/dokumen_' . $kantor . '/' . $filename;
        }

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->download($path, null);
    }
}
