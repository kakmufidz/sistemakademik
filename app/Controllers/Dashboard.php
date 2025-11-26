<?php

namespace App\Controllers;

use App\Models\Karyawan;
use App\Models\Notifikasi;
use App\Models\Users;

class Dashboard extends BaseController
{
    function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        helper(['currency_helper', 'date_helper', 'function_helper']);
    }

    public function index()
    {
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $musers = new Users();
        $mkaryawan = new Karyawan();
        $biodata = $musers->biodata();
        $kantor = ["Workshop", "Onsite"];
        $karyawan = [];
        foreach ($kantor as $sumber) {
            $allkaryawan = $mkaryawan->select("*")->where(["kantor" => $sumber, "deleted_at" => null])->countAllResults();
            $resign = $mkaryawan->select("*")->where(["kantor" => $sumber, "user_status" => 0, "deleted_at" => null])->countAllResults();
            $tetap = $mkaryawan->select("*")->where(["kantor" => $sumber, "user_status" => 1, "deleted_at" => null])->countAllResults();
            $kontrak = $mkaryawan->select("*")->where(["kantor" => $sumber, "user_status" => 2, "deleted_at" => null])->countAllResults();
            $training = $mkaryawan->select("*")->where(["kantor" => $sumber, "user_status" => 3, "deleted_at" => null])->countAllResults();
            $aktif = $tetap + $kontrak + $training;
            $karyawan[strtolower($sumber)] = [
                "all" => $allkaryawan,
                "tetap" => $tetap,
                "resign" => $resign,
                "kontrak" => $kontrak,
                "training" => $training,
                "aktif" => $aktif
            ];
        }
        $data = [
            'page_title' => "Dashboard",
            'biodata' => $biodata,
            'karyawan' => $karyawan,
            'tetap' => $tetap,
            'resign' => $resign,
            'kontrak' => $kontrak,
            'training' => $training,
            'aktif' => $aktif
        ];
        return view('dashboard/dashboard', $data);
    }

    public function proses()
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $muser = new Users();
        $biodata = $muser->biodata();
        $mnotifikasi = new Notifikasi();
        $act = $this->request->getGet("act");
        if ($act == "update_notif") {
            $id = $this->request->getPost("idnotif");

            // Ambil data notifikasi berdasarkan ID
            $notif = $mnotifikasi->select("read_confirm")->where("id", $id)->get()->getRowArray();

            // Kalau tidak ada data, langsung return false
            if (!$notif) {
                $data["update"] = false;
                return $this->response->setJSON($data);
            }

            $current = [];

            // Decode JSON kalau ada isinya
            if (!empty($notif["read_confirm"])) {
                $current = json_decode($notif["read_confirm"], true);
                if (!is_array($current)) {
                    $current = [];
                }
            }

            // Tambahkan usernuk kalau belum ada
            if (!in_array($biodata["usernuk"], $current)) {
                $current[] = $biodata["usernuk"];
            }

            // Update ke database
            $data["update"] = $mnotifikasi->update($id, [
                "read_confirm" => json_encode($current)
            ]);
            return $this->response->setJSON($data);
        }
    }

    public function get_data()
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $muser = new Users();
        $biodata = $muser->biodata();
        $mnotifikasi = new Notifikasi();
        $act = $this->request->getGet("act");
        if ($act == "getnotif") {
            $retun = $mnotifikasi->getNotifikasi($this->request->getPost("kategori"), $biodata["usernuk"]) ?? ["id" => null, "data" => null];
            return $this->response->setJSON($retun);
        }
    }
}
