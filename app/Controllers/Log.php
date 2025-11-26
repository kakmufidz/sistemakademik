<?php

namespace App\Controllers;

use App\Models\Mlog;
use App\Models\Users;

class Log extends BaseController
{
  function __construct()
  {
    $this->session = session();
    $this->db = db_connect();
    helper(['currency_helper', 'date_helper', 'function_helper']);
  }

  public function index()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $muser = new Users();
    $data = [
      'page_title' => "Log Aktifitas",
      'biodata' => $muser->biodata()
    ];
    return view('dashboard/log', $data);
  }
  public function get_data()
  {
    if ($this->session->get('level') == null)  return redirect()->to(base_url());
    $muser = new Users();
    $biodata = $muser->biodata();
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $mlog = new Mlog();
    if ($_GET['act'] == "datalog") {
      $request = service('request');
      $columnOrder = ['id', 'created_by', 'created_at']; // Urutan kolom sesuai di database
      $totalRecords = $mlog->countAllResults();

      // Pencarian
      $search = $request->getPost('search')['value'];
      if ($search) {
        $mlog->groupStart()
          ->like('nama_tabel', $search)
          ->orLike('created_by', $search)
          ->groupEnd();
      }

      // Filter, pencarian dan paginasi
      $totalFiltered = $mlog->countAllResults(false);

      $start = $request->getPost('start');
      $length = $request->getPost('length');
      $orderColumn = $columnOrder[$request->getPost('order')[0]['column']];
      $orderDir = $request->getPost('order')[0]['dir'];

      $datalog = $mlog->orderBy('created_at', 'DESC')->orderBy($orderColumn, $orderDir)->limit($length, $start)->get()->getResultArray();

      $menus = [
        "department" => "Department",
        "karyawan" => "Karyawan",
        "user" => "User",
        "settings" => "Settings",
        "pendidikan" => "Pendidikan",
        "riwayat_kerja" => "Riwayat Pekerjaan",
        "kontrak" => "Kontrak",
        "dokumen" => "Dokumen",
        "settings_notification" => "Pengaturan Notifikasi",
        "notifikasi" => "Notifikasi",
        "pelatihan" => "Pelatihan",
        "pembinaan" => "Pembinaan",
        "kesehatan" => "Kesehatan",
      ];

      $data = [];
      $no = $start + 1; // Mulai nomor berdasarkan index 'start'
      foreach ($datalog as $log) {

        if ($log["aktifitas"] == "delete") {
          $doing = "menghapus data ";
        } elseif ($log["aktifitas"] == "update") {
          $doing = "merubah data ";
        } elseif ($log["aktifitas"] == "update_photo") {
          $doing = "merubah foto ";
        } else {
          $doing = "menambah data ";
        }
        // Mendekode string JSON dari field 'sesudah'
        $sesudahData = json_decode($log['sesudah'], true);

        if ($log["nama_tabel"] == "settings") {
          $field = $sesudahData['field'] ?? null;
          if ($field == "panduan") {
            $menu = "Peraturan, Syarat & Ketentuan";
          } else {
            $menu = "Settings";
          }
        } else {
          $menu = $menus[$log["nama_tabel"]];
        }

        $tabel = $log["nama_tabel"];

        $datatabel = $this->db->table($tabel)->select("*")->where("id", $log["id_data"])->get()->getRowArray();
        $href = "javascript:;";
        $target = "";
        if (isset($datatabel)) {
          if ($tabel == "karyawan") {
            $base64Encoded = base64_encode($datatabel['usernuk'] . "additional");
            $href =  base_url("karyawan/detail?key=" . $base64Encoded);
            $target = " " . $datatabel['user_nama_depan'] . " " . $datatabel['user_nama_belakang'];
          } elseif ($tabel == "pendidikan") {
            $base64Encoded = base64_encode($datatabel['usernuk'] . "additional");
            $datatarget = $this->db->table("karyawan")->select("*")->where(["usernuk" => $datatabel['usernuk']])->get()->getRowArray();
            if ($datatarget) {
              $href =  base_url("karyawan/detail?key=" . $base64Encoded . "#tabPendidikan");
              $target = " " . $datatarget['user_nama_depan'] . " " . $datatarget['user_nama_belakang'];
            }
          } elseif ($tabel == "riwayat_kerja") {
            $base64Encoded = base64_encode($datatabel['usernuk'] . "additional");
            $datatarget = $this->db->table("karyawan")->select("*")->where(["usernuk" => $datatabel['usernuk']])->get()->getRowArray();
            if ($datatarget) {
              $href =  base_url("karyawan/detail?key=" . $base64Encoded . "#tabPendidikan");
              $target = " " . $datatarget['user_nama_depan'] . " " . $datatarget['user_nama_belakang'];
            }
          } elseif ($tabel == "dokumen") {
            $base64Encoded = base64_encode($datatabel['usernuk'] . "additional");
            $datatarget = $this->db->table("karyawan")->select("*")->where(["usernuk" => $datatabel['usernuk']])->get()->getRowArray();
            if ($datatarget) {
              $href =  base_url("karyawan/detail?key=" . $base64Encoded . "&act=dokumen");
              $target = " " . $datatarget['user_nama_depan'] . " " . $datatarget['user_nama_belakang'];
            }
          } elseif ($tabel == "kontrak") {
            $base64Encoded = base64_encode($datatabel['usernuk'] . "additional");
            $datatarget = $this->db->table("karyawan")->select("*")->where(["usernuk" => $datatabel['usernuk']])->get()->getRowArray();
            if ($datatarget) {
              $href =  base_url("karyawan/detail?key=" . $base64Encoded . "&act=kontrak");
              $target = " " . $datatarget['user_nama_depan'] . " " . $datatarget['user_nama_belakang'];
            }
          } elseif ($tabel == "settings_notification") {
            if ($datatabel["kategori"] == "notif_kontrak") {
              $href =  base_url("settings/notifikasi");
              $target = " Kontrak";
            }
          }
        }
        $biodata = $this->db->table("karyawan")->select("*")->where(["usernuk" => $log["created_by"]])->get()->getRowArray();
        $namacreator = (isset($biodata)) ? $biodata['user_nama_depan'] . " " . $biodata['user_nama_belakang'] : "Admin";
        $aktifitas = '<a href=' . $href . ' class="text-dark text-hover-primary fw-bold">' . ucfirst($namacreator) . ' telah ' . $doing . $menu . $target . '</a>';
        $interval = interval($log["created_at"]);
        $data[] = [
          $no++,
          $aktifitas,
          $interval,
        ];
      }

      $response = [
        'draw' => intval($request->getPost('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalFiltered,
        'data' => $data,
      ];

      return $this->response->setJSON($response);
    }
  }
}
