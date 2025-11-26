<?php

namespace App\Controllers;

use App\Models\Dokumen;
use App\Models\Pendidikan;
use App\Models\Riwayat_kerja;
use App\Models\Users;

class Profile extends BaseController
{
    function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
        $this->mpendidikan = new Pendidikan();
        $this->mriwayatkerja = new Riwayat_kerja();
        $this->mdokumen = new Dokumen();
        helper(['currency_helper', 'date_helper', 'function_helper']);
    }

    public function index()
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $muser = new Users();
        $biodata = $muser->biodata();
        $datapendidikan = $this->mpendidikan->select("*")->where(["usernuk" => $biodata["usernuk"], "deleted_at" => null])->orderBy("tahun", "DESC")->get()->getResultArray();
        $datariwayatkerja = $this->mriwayatkerja->select("*")->where(["usernuk" => $biodata["usernuk"], "deleted_at" => null])->orderBy("tahun", "DESC")->get()->getResultArray();
        $datadokumen = $this->mdokumen->select("*")->where(["usernuk" => $biodata["usernuk"], "deleted_at" => null])->orderBy("created_at", "DESC")->get()->getResultArray();
        $data = [
            'page_title' => "Profile",
            'biodata' => $biodata,
            'datapendidikan' => $datapendidikan,
            'datariwayatkerja' => $datariwayatkerja,
            'datadokumen' => $datadokumen,
        ];
        $navmenu = ["dokumen", "ubah_password"];
        $act = $this->request->getGet("act");

        $view = 'profile/detail'; // default view
        if ($act && in_array($act, $navmenu)) {
            $view = 'profile/' . $act;
        }
        return view($view, $data);
    }

    public function proses()
    {
        // Cek session
        if ($this->cek_session() !== true) {
            return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
        }
        $muser = new Users();
        $biodata = $muser->biodata();
        if ($_GET['act'] == "ubah_password") {
            $oldpassword = $this->request->getPost("oldpassword");
            $newpassword = $this->request->getPost("newpassword");
            $repassword = $this->request->getPost("repassword");
            if (empty($oldpassword) && empty($newpassword) && empty($repassword)) {
                $data["errors"] = "Harap periksa apakah form sudah terisi semua.";
            } else {
                $dataUser = $muser->user($biodata['usernuk']);
                if ($oldpassword == $dataUser['password']) {
                    if ($newpassword != $repassword) {
                        $data["errors"] = "Harap periksa apakah ulangi password sudah sama dengan password baru.";
                    } else {
                        $update_data = [
                            'password' => $newpassword,
                        ];
                        $data['proses'] = $muser->update($dataUser["id"], $update_data);
                    }
                } else {
                    $data['errors'] = 'Password lama tidak cocok';
                }
            }
            return $this->response->setJSON($data);
        }
    }
}
