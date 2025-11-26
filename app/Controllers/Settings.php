<?php

namespace App\Controllers;

use App\Models\Mlog;
use App\Models\Users;

class Settings extends BaseController
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
        return view('dashboard/dashboard');
    }

    public function notifikasi()
    {
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $musers = new Users();
        $biodata = $musers->biodata();
        $data = [
            'page_title' => "Settings",
            'biodata' => $biodata,
        ];
        return view('settings/notifications', $data);
    }

    public function proses()
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $muser = new Users();
        $biodata = $muser->biodata();
        $mlog = new Mlog();
        $act = $this->request->getGet("act");
        if ($act == "update_notif_kontrak") {
            $notif_status = $this->request->getPost("notif_status") ?? "off";
            $nama       = $this->request->getPost("nama") ?? [];
            $phone      = $this->request->getPost("phone") ?? [];
            $basenotif  = $this->request->getPost("basenotif") ?? [];
            $status_nomor = $this->request->getPost("status_nomor") ?? [];
            $penerima = [];
            foreach ($phone as $i => $nomor) {
                $penerima[] = [
                    "nama"      => $nama[$i] ?? "",
                    "phone"     => $nomor,
                    "basenotif" => $basenotif[$i] ?? "",
                    "status"    => $status_nomor[$i] ?? "off"
                ];
            }
            $datasetting["penerima"] = $penerima;
            $input_data = [
                'kategori' => 'notif_kontrak',
                'status' => $notif_status,
                'datasetting' => json_encode($datasetting),
            ];

            $setting = $this->db->table("settings_notification")->select("*")->where('kategori', 'notif_kontrak')->get()->getRowArray();
            if ($setting) {
                $data['proses'] = $this->db->table("settings_notification")->set($input_data)->where('id', $setting["id"])->update();
                $id_data = $setting["id"];
                $aktifitas = "update";
            } else {
                $data['proses'] = $this->db->table("settings_notification")->insert($input_data);
                $id_data = $this->db->insertID();
                $aktifitas = "create";
            }
            if ($data['proses']) {
                $newData = $this->db->table("settings_notification")->select("*")->where("id", $id_data)->get()->getRowArray();
                $tgl_data = date("Y-m-d H:i:s", strtotime($newData["created_at"]));
                $sebelum = ($setting) ? json_encode($setting, JSON_UNESCAPED_UNICODE) : null;
                $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
                $data_aktifitas = [
                    'nama_tabel' => "settings_notification",
                    'id_data' => $id_data,
                    'tgl_data' => $tgl_data,
                    'sebelum' => $sebelum,
                    'sesudah' => $sesudah,
                    'aktifitas' => $aktifitas,
                    'created_by' => $biodata["usernuk"]
                ];
                $data['log'] = $mlog->save($data_aktifitas);
            }
            return $this->response->setJSON($data);
        }
    }
}
