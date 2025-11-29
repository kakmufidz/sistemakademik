<?php

namespace App\Controllers;

use App\Models\Karyawan as ModelsKaryawan;
use App\Models\Mlog;
use App\Models\Users;

class Biodata extends BaseController
{
  function __construct()
  {
    $this->session = session();
    $this->request = service('request');
    $this->db = db_connect();
    helper(['currency_helper', 'date_helper', 'function_helper']);
  }

  public function index()
  {
    return redirect()->to(base_url("biodata/siswa"));
  }

  public function siswa()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $musers = new Users();
    $biodata = $musers->biodata();
    $data = [
      'page_title' => "Data Siswa",
      'biodata' => $biodata,
    ];
    return view('master/siswa/list_data', $data);
  }

  public function wali_siswa()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $musers = new Users();
    $biodata = $musers->biodata();
    $data = [
      'page_title' => "Data Wali Siswa",
      'biodata' => $biodata,
    ];
    return view('master/wali_siswa/list_data', $data);
  }

  public function guru()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $musers = new Users();
    $biodata = $musers->biodata();
    $data = [
      'page_title' => "Data Guru",
      'biodata' => $biodata,
    ];
    return view('master/guru/list_data', $data);
  }

  public function tambah_data()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $musers = new Users();
    $biodata = $musers->biodata();
    $act = $this->request->getGet("act");
    $view = 'master/' . $act . '/tambah_data';
    $data = [
      'page_title' => "Tambah Data " . ucfirst($act),
      'biodata' => $biodata,
    ];
    return view($view, $data);
  }


  public function detail()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $musers = new Users();
    $getKey = $this->request->getGet('key');
    $encryptedDataKey = base64_decode($getKey);
    $nuk = str_replace("additional", "", $encryptedDataKey);
    $data = [
      'page_title' => "Data Karyawan",
      'biodata' =>  $musers->biodata(),
    ];
    $data["karyawan"] = $this->db->table("karyawan k")
      ->select("k.*,dept.nama as department")
      ->join("department dept", "dept.id=id_department")
      ->where(["usernuk" => $nuk, "deleted_at" => null])
      ->get()->getRowArray();
    if (!$data["karyawan"]) {
      // Panggil view 404 custom dan kirimkan data POST
      return $this->response->setStatusCode(404)
        ->setBody(view('errors/html/error_404', [
          'nuk' => $nuk,
          'reff' => "karyawan_detail"
        ]));
    }
    $data["kantor"] = strtolower($data["karyawan"]["kantor"]);
    $navmenu = ["dokumen", "kontrak", "pelatihan", "pembinaan", "kesehatan"];
    $act = $this->request->getGet("act");
    if ($act && in_array($act, $navmenu)) {
      if ($act == "dokumen") {
        $data["datadokumen"] = $this->db->table("dokumen")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("created_at", "DESC")->get()->getResultArray();
      } elseif ($act == "kontrak") {
        $data["datakontrak"] = $this->db->table("kontrak")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("tgl_mulai", "DESC")->get()->getResultArray();
      } elseif ($act == "pelatihan") {
        $data["datapelatihan"] = $this->db->table("pelatihan")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("tgl_mulai", "DESC")->get()->getResultArray();
      } elseif ($act == "pembinaan") {
        $data["datapembinaan"] = $this->db->table("pembinaan")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("tanggal", "DESC")->get()->getResultArray();
      } elseif ($act == "kesehatan") {
        $data["datakesehatan"] = $this->db->table("kesehatan")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("tanggal", "DESC")->get()->getResultArray();
      }
      $view = 'hrd/karyawan/detail/' . $act;
    } else {
      $data["datapendidikan"] =  $this->db->table("pendidikan")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("tahun", "DESC")->get()->getResultArray();
      $data["datariwayatkerja"] = $this->db->table("riwayat_kerja")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->orderBy("tahun", "DESC")->get()->getResultArray();
      $view = 'hrd/karyawan/detail/detail'; // default view
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
    $mkaryawan = new ModelsKaryawan();
    $mlog = new Mlog();
    $act = $this->request->getGet("act");
    if ($act == "input_karyawan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'NUK',
          'rules' => 'required|is_unique[karyawan.usernuk]',
          'errors' => [
            'is_unique' => 'NUK sudah terdaftar.',
          ]
        ],
        'nik' => [
          'label' => 'NIK',
          'rules' => 'required|is_unique[karyawan.nik]',
          'errors' => [
            'is_unique' => 'NIK sudah terdaftar.',
          ]
        ],
        'namaDepan' => [
          'label' => 'Nama Depan',
          'rules' => 'required'
        ],
        'tempatLahir' => [
          'label' => 'Tempat Lahir',
          'rules' => 'required'
        ],
        'tanggalLahir' => [
          'label' => 'Tanggal Lahir',
          'rules' => 'required'
        ],
        'jenisKelamin' => [
          'label' => 'Jenis Kelamin',
          'rules' => 'required'
        ],
        'agama' => [
          'label' => 'Agama',
          'rules' => 'required'
        ],
        'perkawinan' => [
          'label' => 'Status Perkawinan',
          'rules' => 'required'
        ],
        'alamat' => [
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        'department' => [
          'label' => 'Department',
          'rules' => 'required'
        ],
        'jabatan' => [
          'label' => 'Jabatan',
          'rules' => 'required'
        ],
        'masukKerja' => [
          'label' => 'Tanggal masuk kerja',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $kantor = ucfirst(strtolower($this->request->getPost("kantor")));
        $birthday = date("Y-m-d", strtotime($this->request->getPost("tanggalLahir")));
        $masukkerja = date("Y-m-d", strtotime($this->request->getPost("masukKerja")));
        $password = generateRandomCode(6);
        $input_data = [
          'kantor' => $kantor,
          'usernuk' => $this->request->getPost("usernuk"),
          'nik' => $this->request->getPost("nik"),
          'user_nama_depan' => $this->request->getPost("namaDepan"),
          'user_nama_belakang' => $this->request->getPost("namaBelakang"),
          'tmpat_lahir' => $this->request->getPost("tempatLahir"),
          'birthday' => $birthday,
          'jk' => $this->request->getPost("jenisKelamin"),
          'agama' => $this->request->getPost("agama"),
          'golda' => $this->request->getPost("golonganDarah"),
          'status_perkawinan' => $this->request->getPost("perkawinan"),
          'no_telp' => $this->request->getPost("telp"),
          'email' => $this->request->getPost("email"),
          'alamat' => $this->request->getPost("alamat"),
          'npwp' => $this->request->getPost("npwp"),
          'no_bpjs' => $this->request->getPost("bpjs"),
          'no_jht' => $this->request->getPost("jht"),
          'no_rek' => $this->request->getPost("rekeningMandiri"),
          'id_department' => $this->request->getPost("department"),
          'jabatan' => $this->request->getPost("jabatan"),
          'reg_date' => $masukkerja,
          'password' => $password,
          'user_status' => 3,
          'user_type' => 0
        ];
        $data['insert'] = $mkaryawan->save($input_data);
        $id_data = $mkaryawan->insertID();
        $input_user = [
          'usernuk' => $this->request->getPost("usernuk"),
          'password' => $password
        ];
        $data['insert'] = $muser->save($input_user);
        if ($data['insert']) {
          $newData = $mkaryawan->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = date("Y-m-d H:i:s", strtotime($newData["created_at"]));
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "karyawan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "upload_photo") {
      $file = $this->request->getFile('avatar');
      $nuk = $this->request->getPost('usernuk');

      $response = ['success' => false, 'message' => 'Terjadi kesalahan'];

      if (!$file || !$file->isValid()) {
        $response['message'] = 'File tidak valid atau tidak ditemukan.';
        return $this->response->setJSON($response);
      }

      // Validasi ekstensi dan mime
      $allowedMime = ['image/jpeg', 'image/png'];
      $allowedExt  = ['jpg', 'jpeg', 'png'];
      $maxSize     = 2 * 1024 * 1024; // 2MB

      if (!in_array($file->getClientMimeType(), $allowedMime)) {
        $response['message'] = 'Hanya file JPG dan PNG yang diperbolehkan.';
        return $this->response->setJSON($response);
      }

      if (!in_array($file->getExtension(), $allowedExt)) {
        $response['message'] = 'Ekstensi file tidak didukung.';
        return $this->response->setJSON($response);
      }

      if ($file->getSize() > $maxSize) {
        $response['message'] = 'Ukuran file melebihi batas maksimum 2MB.';
        return $this->response->setJSON($response);
      }

      // Proses jika valid
      $datakaryawan = $this->db->table("karyawan")->select("*")->where(["usernuk" => $nuk, "deleted_at" => null])->get()->getRowArray();

      $newName = $file->getRandomName();

      // Cek dan hapus foto lama jika ada
      if (!empty($datakaryawan['photo']) && file_exists(FCPATH . $datakaryawan['photo'])) {
        @unlink(FCPATH . $datakaryawan['photo']); // Hapus file lama
      }

      $file->move(FCPATH . 'photo', $newName);

      $this->db->table("karyawan")->set(['photo' => 'photo/' . $newName])->where("id", $datakaryawan["id"])->update();


      $response = [
        'success' => true,
        'photo_url' => base_url('photo/' . $newName)
      ];
      if ($response['success'] == true) {
        $id_data = $datakaryawan["id"];
        $newData = $this->db->table("karyawan")->select("*")->where("id", $id_data)->get()->getRowArray();
        $tgl_data = date("Y-m-d H:i:s", strtotime($newData["updated_at"]));
        $sebelum = json_encode($datakaryawan);
        $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
        $data_aktifitas = [
          'nama_tabel' => "karyawan",
          'id_data' => $id_data,
          'tgl_data' => $tgl_data,
          'sebelum' => $sebelum,
          'sesudah' => $sesudah,
          'aktifitas' => "update_photo",
          'created_by' => $biodata["usernuk"]
        ];
        $data['log'] = $mlog->save($data_aktifitas);
      }

      return $this->response->setJSON($response);
    } elseif ($act == "edit_biodata") {
      $validationRule = [
        'usernuk' => [
          'label' => 'NUK',
          'rules' => 'required',
          'errors' => [
            'required' => 'Tidak dapat menemukan NUK.',
          ]
        ],
        'nik' => [
          'label' => 'NIK',
          'rules' => 'required|numeric',
          'errors' => [
            'is_unique' => 'Tidak dapat menemukan NUK.',
          ]
        ],
        'namaDepan' => [
          'label' => 'Nama Depan',
          'rules' => 'required'
        ],
        'tempatLahir' => [
          'label' => 'Tempat Lahir',
          'rules' => 'required'
        ],
        'tanggalLahir' => [
          'label' => 'Tanggal Lahir',
          'rules' => 'required'
        ],
        'jenisKelamin' => [
          'label' => 'Jenis Kelamin',
          'rules' => 'required'
        ],
        'agama' => [
          'label' => 'Agama',
          'rules' => 'required'
        ],
        'perkawinan' => [
          'label' => 'Status Perkawinan',
          'rules' => 'required'
        ],
        'alamat' => [
          'label' => 'Alamat',
          'rules' => 'required'
        ],
        'department' => [
          'label' => 'Department',
          'rules' => 'required'
        ],
        'jabatankantor' => [
          'label' => 'Jabatan',
          'rules' => 'required'
        ]
      ];

      if (!empty($this->request->getPost("telp"))) {
        $validationRule["telp"] = [
          'label' => 'No Telpon',
          'rules' => 'numeric'
        ];
      }
      if (!empty($this->request->getPost("npwp"))) {
        $validationRule["npwp"] = [
          'label' => 'NPWP',
          'rules' => 'numeric'
        ];
      }
      if (!empty($this->request->getPost("bpjs"))) {
        $validationRule["bpjs"] = [
          'label' => 'BPJS',
          'rules' => 'numeric'
        ];
      }
      if (!empty($this->request->getPost("jht"))) {
        $validationRule["jht"] = [
          'label' => 'JHT',
          'rules' => 'numeric'
        ];
      }
      if (!empty($this->request->getPost("rekeningMandiri"))) {
        $validationRule["rekeningMandiri"] = [
          'label' => 'No Rekening Mandiri',
          'rules' => 'numeric'
        ];
      }

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $birthday = date("Y-m-d", strtotime($this->request->getPost("tanggalLahir")));
        $usernuk = $this->request->getPost("usernuk");
        $update_data = [
          'user_nama_depan' => $this->request->getPost("namaDepan"),
          'user_nama_belakang' => $this->request->getPost("namaBelakang"),
          'tmpat_lahir' => $this->request->getPost("tempatLahir"),
          'birthday' => $birthday,
          'jk' => $this->request->getPost("jenisKelamin"),
          'agama' => $this->request->getPost("agama"),
          'golda' => $this->request->getPost("golonganDarah"),
          'status_perkawinan' => $this->request->getPost("perkawinan"),
          'no_telp' => $this->request->getPost("telp"),
          'email' => $this->request->getPost("email"),
          'alamat' => $this->request->getPost("alamat"),
          'nik' => $this->request->getPost("nik"),
          'npwp' => $this->request->getPost("npwp"),
          'no_bpjs' => $this->request->getPost("bpjs"),
          'no_jht' => $this->request->getPost("jht"),
          'no_rek' => $this->request->getPost("rekeningMandiri"),
          'id_department' => $this->request->getPost("department"),
          'jabatan' => $this->request->getPost("jabatankantor")
        ];

        $oldData = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();

        $id_data = $oldData["id"];
        $data['proses'] = $this->db->table("karyawan")
          ->set($update_data)
          ->where(["id" => $id_data])
          ->update();
        if ($data['proses']) {
          $newData = $this->db->table("karyawan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = date("Y-m-d H:i:s", strtotime($newData["updated_at"]));
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "karyawan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_status") {
      $validationRule = [
        'status' => [
          'label' => 'Status',
          'rules' => 'required'
        ]
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $status = $this->request->getPost("status");
        $reg_date = date("Y-m-d", strtotime($this->request->getPost("tanggalMasuk")));
        $resign_date = ($status == 0) ? date("Y-m-d", strtotime($this->request->getPost("tanggalKeluar"))) : null;
        $update_data = [
          "user_status" => $status,
          "reg_date" => $reg_date,
          "resign_date" => $resign_date
        ];
        $oldData = $this->db->table("karyawan")->select("*")->where(["usernuk" => $usernuk])->get()->getRowArray();
        $id_data = $oldData["id"];
        $data['proses'] = $this->db->table("karyawan")->set($update_data)->where("id", $id_data)->update();

        if ($data['proses']) {
          $newData = $this->db->table("karyawan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = date("Y-m-d H:i:s", strtotime($newData["updated_at"]));
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "karyawan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_sekolah") {
      $validationRule = [
        'tahun' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'sekolah' => [
          'label' => 'Tempat Sekolah',
          'rules' => 'required'
        ]
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $sekolah = ($this->request->getPost("sekolah") == "sekolah-lain") ? $this->request->getPost("sekolah_lain") : $this->request->getPost("sekolah");
        $jurusan = ($this->request->getPost("jurusan") == "jurusan-lain") ? $this->request->getPost("jurusan_lain") : ($this->request->getPost("jurusan") ?? null);

        $input_data = [
          "usernuk" => $this->request->getPost("usernuk"),
          "tahun" => $this->request->getPost("tahun"),
          "tempat" => $sekolah,
          "jurusan" => $jurusan,
          // "created_at" => date("Y-m-d H:i:s") // jika kamu mengelola timestamp manual
        ];
        $data['insert'] = $this->db->table("pendidikan")->insert($input_data);
        $id_data = $this->db->insertID();

        if ($data['insert']) {
          $newData = $this->db->table("pendidikan")->select("*")->where("id", $id_data)->get()->getRowArray();

          // Gunakan waktu saat ini jika kolom created_at tidak pasti
          $tgl_data = isset($newData["created_at"]) ? date("Y-m-d H:i:s", strtotime($newData["created_at"])) : date("Y-m-d H:i:s");

          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "pendidikan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_sekolah") {
      $validationRule = [
        'tahun' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'sekolah' => [
          'label' => 'Tempat Sekolah',
          'rules' => 'required'
        ]
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        $sekolah = ($this->request->getPost("sekolah") === "sekolah-lain")
          ? $this->request->getPost("sekolah_lain")
          : $this->request->getPost("sekolah");

        $jurusan = ($this->request->getPost("jurusan") === "jurusan-lain")
          ? $this->request->getPost("jurusan_lain")
          : ($this->request->getPost("jurusan") ?? null);

        $update_data = [
          "tahun"   => $this->request->getPost("tahun"),
          "tempat"  => $sekolah,
          "jurusan" => $jurusan
        ];

        // Ambil data lama untuk keperluan log
        $oldData = $this->db->table("pendidikan")->where("id", $id_data)->get()->getRowArray();

        if ($oldData) {
          // Update data
          $data['proses'] = $this->db->table("pendidikan")->set($update_data)->where("id", $id_data)->update();

          if ($data['proses']) {
            // Ambil data baru setelah update
            $newData = $this->db->table("pendidikan")->where("id", $id_data)->get()->getRowArray();

            // Gunakan updated_at jika ada, fallback ke sekarang
            $tgl_data = isset($newData['updated_at'])
              ? date("Y-m-d H:i:s", strtotime($newData["updated_at"]))
              : date("Y-m-d H:i:s");

            $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
            $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);

            // Simpan log perubahan
            $data_aktifitas = [
              'nama_tabel' => "pendidikan",
              'id_data'    => $id_data,
              'tgl_data'   => $tgl_data,
              'sebelum'    => $sebelum,
              'sesudah'    => $sesudah,
              'aktifitas'  => "update",
              'created_by' => $biodata["usernuk"]
            ];

            $data['log'] = $mlog->save($data_aktifitas);
          }
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_sekolah") {
      $validationRule = [
        'id' => [
          'label' => 'Sekolah',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        $oldData = $this->db->table("pendidikan")->select("*")->where("id", $id_data)->get()->getRowArray();
        $data['delete'] = $this->db->table("pendidikan")->set(['deleted_at' => date("Y-m-d H:i:s")])->where(["id" => $id_data])->update();
        if ($data['delete']) {
          $newData = $this->db->table("pendidikan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = isset($newData["updated_at"]) ? date("Y-m-d H:i:s", strtotime($newData["updated_at"])) : date("Y-m-d H:i:s");
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "pendidikan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "delete",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_pekerjaan") {
      $validationRule = [
        'tahun' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'perusahaan' => [
          'label' => 'Perusahaan',
          'rules' => 'required'
        ],
        'jabatan' => [
          'label' => 'Jabatan',
          'rules' => 'required'
        ]
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $perusahaan = ($this->request->getPost("perusahaan") == "perusahaan-lain")
          ? $this->request->getPost("perusahaan_lain")
          : $this->request->getPost("perusahaan");

        $jabatan = ($this->request->getPost("jabatan") == "jabatan-lain")
          ? $this->request->getPost("jabatan_lain")
          : ($this->request->getPost("jabatan") ?? null);

        $input_data = [
          "usernuk" => $this->request->getPost("usernuk"),
          "tahun" => $this->request->getPost("tahun"),
          "tempat" => $perusahaan,
          "jabatan" => $jabatan
        ];

        $data['insert'] = $this->db->table("riwayat_kerja")->insert($input_data);
        $id_data = $this->db->insertID();

        if ($data['insert']) {
          $newData = $this->db->table("riwayat_kerja")->select("*")->where("id", $id_data)->get()->getRowArray();

          $tgl_data = isset($newData["created_at"]) ? date("Y-m-d H:i:s", strtotime($newData["created_at"])) : date("Y-m-d H:i:s");
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);

          $data_aktifitas = [
            'nama_tabel' => "riwayat_kerja",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];

          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_pekerjaan") {
      $validationRule = [
        'tahun' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'perusahaan' => [
          'label' => 'Perusahaan',
          'rules' => 'required'
        ],
        'jabatan' => [
          'label' => 'Jabatan',
          'rules' => 'required'
        ]
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data   = $this->request->getPost("id");
        $perusahaan = ($this->request->getPost("perusahaan") === "perusahaan-lain")
          ? $this->request->getPost("perusahaan_lain")
          : $this->request->getPost("perusahaan");

        $jabatan = ($this->request->getPost("jabatan") === "jabatan-lain")
          ? $this->request->getPost("jabatan_lain")
          : ($this->request->getPost("jabatan") ?? null);

        $update_data = [
          "usernuk" => $this->request->getPost("usernuk"),
          "tahun"   => $this->request->getPost("tahun"),
          "tempat"  => $perusahaan,
          "jabatan" => $jabatan
        ];

        // Simpan data lama untuk log
        $oldData = $this->db->table("riwayat_kerja")->select("*")->where("id", $id_data)->get()->getRowArray();

        // Lakukan update
        $data['proses'] = $this->db->table("riwayat_kerja")->set($update_data)->where("id", $id_data)->update();

        if ($data['proses']) {
          $newData = $this->db->table("riwayat_kerja")->select("*")->where("id", $id_data)->get()->getRowArray();

          // Gunakan fallback waktu saat ini jika tidak ada updated_at
          $tgl_data = isset($newData["updated_at"])
            ? date("Y-m-d H:i:s", strtotime($newData["updated_at"]))
            : date("Y-m-d H:i:s");

          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);

          $data_aktifitas = [
            'nama_tabel' => "riwayat_kerja",
            'id_data'    => $id_data,
            'tgl_data'   => $tgl_data,
            'sebelum'    => $sebelum,
            'sesudah'    => $sesudah,
            'aktifitas'  => "update",
            'created_by' => $biodata["usernuk"]
          ];

          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_pekerjaan") {
      $validationRule = [
        'id' => [
          'label' => 'Riwayat Pekerjaan',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        $oldData = $this->db->table("riwayat_kerja")->select("*")->where("id", $id_data)->get()->getRowArray();
        $data['delete'] = $this->db->table("riwayat_kerja")->set(['deleted_at' => date("Y-m-d H:i:s")])->where(["id" => $id_data])->update();
        if ($data['delete']) {
          $newData = $this->db->table("riwayat_kerja")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = date("Y-m-d H:i:s", strtotime($newData["updated_at"]));
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "riwayat_kerja",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "delete",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_dokumen") {
      $validationRule = [
        'filedokumen' => [
          'label' => 'File Dokumen',
          'rules' => 'uploaded[filedokumen]|max_size[filedokumen,2048]|ext_in[filedokumen,jpg,jpeg,png,pdf]',
          'errors' => [
            'uploaded'  => '{field} wajib diunggah.',
            'max_size'  => '{field} tidak boleh lebih dari 2MB.',
            'ext_in'    => '{field} harus dalam format jpg, jpeg, png, atau pdf.'
          ]
        ]
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            $notempty[] = $name;
          }
        }

        $data = [
          'notempty' => $notempty,
          'errors'   => $this->validator->getErrors()
        ];
      } else {
        $dokumenName = null;
        $file = $this->request->getFile('filedokumen');
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")->select("*")->where(["usernuk" => $usernuk])->get()->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        if ($file && $file->isValid() && !$file->hasMoved()) {
          $extension = strtolower($file->getClientExtension());

          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_' . date('YmdHis') . '.' . ($extension === 'png' ? 'jpg' : $extension);

          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_' . $kantor;

          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }

          $destinationPath = $uploadPath . '/' . $dokumenName;

          if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            // Kompres jika ukuran > 500KB
            if ($file->getSize() > 512000) {
              compressImage($file->getTempName(), $destinationPath, 75); // kualitas kompresi
            } else {
              $file->move($uploadPath, $dokumenName);
            }
          } elseif ($extension === 'pdf') {
            $file->move($uploadPath, $dokumenName);
          }
        }

        // Simpan data dokumen
        $input_data = [
          'usernuk'   => $usernuk,
          'nama_file' => $dokumenName,
          'note'      => $this->request->getPost("catatan")
        ];

        $data['insert'] = $this->db->table("dokumen")->insert($input_data);
        $id_data = $this->db->insertID();

        if ($data['insert']) {
          $newData = $this->db->table("dokumen")->where("id", $id_data)->get()->getRowArray();

          // Gunakan created_at jika tersedia, jika tidak fallback ke now
          $tgl_data = isset($newData["created_at"])
            ? date("Y-m-d H:i:s", strtotime($newData["created_at"]))
            : date("Y-m-d H:i:s");

          $data_aktifitas = [
            'nama_tabel' => "dokumen",
            'id_data'    => $id_data,
            'tgl_data'   => $tgl_data,
            'sesudah'    => json_encode($newData, JSON_UNESCAPED_UNICODE),
            'aktifitas'  => 'upload',
            'created_by' => $biodata["usernuk"]
          ];

          $data['log'] = $mlog->save($data_aktifitas);
        }
      }

      return $this->response->setJSON($data);
    } elseif ($act == "delete_dokumen") {
      $validationRule = [
        'id' => [
          'label' => 'Dokumen',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        // Ambil data sebelum dihapus untuk log
        $oldData = $this->db->table("dokumen")->where("id", $id_data)->get()->getRowArray();

        if ($oldData) {
          // Tandai sebagai dihapus (soft delete)
          $data['delete'] = $this->db->table("dokumen")->set(['deleted_at' => date("Y-m-d H:i:s")])->where("id", $id_data)->update();

          if ($data['delete']) {
            // Ambil data terbaru setelah update
            $newData = $this->db->table("dokumen")->where("id", $id_data)->get()->getRowArray();

            // Gunakan updated_at jika tersedia, jika tidak fallback ke sekarang
            $tgl_data = isset($newData['updated_at'])
              ? date("Y-m-d H:i:s", strtotime($newData['updated_at']))
              : date("Y-m-d H:i:s");

            // Log aktifitas
            $data_aktifitas = [
              'nama_tabel' => "dokumen", // gunakan nama tabel lengkap, bukan 'dokumen' saja
              'id_data'    => $id_data,
              'tgl_data'   => $tgl_data,
              'sebelum'    => json_encode($oldData, JSON_UNESCAPED_UNICODE),
              'sesudah'    => json_encode($newData, JSON_UNESCAPED_UNICODE),
              'aktifitas'  => 'delete',
              'created_by' => $biodata['usernuk']
            ];

            $data['log'] = $mlog->save($data_aktifitas);
          }
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "ubah_password") {
      // Sampe sini
      $usernuk = $this->request->getPost("usernuk");
      $oldpassword = $this->request->getPost("oldpassword");
      $newpassword = $this->request->getPost("newpassword");
      $repassword = $this->request->getPost("repassword");
      if (empty($oldpassword) && empty($newpassword) && empty($repassword)) {
        $data["errors"] = "Harap periksa apakah form sudah terisi semua.";
      } else {
        $dataUser = $muser->user($usernuk);
        if (isset($dataUser)) {
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
        } else {
          $datakaryawan = $this->db->table("karyawan")
            ->select("*")
            ->where(["usernuk" => $usernuk])
            ->get()
            ->getRowArray();
          if (isset($datakaryawan)) {
            $kantor = strtolower($datakaryawan["kantor"]);
            $insert_data = [
              'usernuk ' => $usernuk,
              'password' => $newpassword,
              'office ' => $kantor,
              'user_status' => 1
            ];
            $data['proses'] = $muser->save($insert_data);
          }
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_kontrak") {
      $validationRule = [
        'usernuk' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'jenis_kontrak' => [
          'label' => 'Jenis',
          'rules' => 'required'
        ],
        'department' => [
          'label' => 'Department',
          'rules' => 'required'
        ],
        'jabatan' => [
          'label' => 'Jabatan',
          'rules' => 'required'
        ],
        'tgl_mulai' => [
          'label' => 'Tanggal Mulai',
          'rules' => 'required'
        ],
        // 'filedokumen' => [
        //   'label' => 'File Dokumen',
        //   'rules' => 'uploaded[filedokumen]|max_size[filedokumen,2048]|ext_in[filedokumen,pdf]',
        //   'errors' => [
        //     'uploaded'  => '{field} wajib diunggah.',
        //     'max_size'  => '{field} tidak boleh lebih dari 2MB.',
        //     'ext_in'    => '{field} harus dalam format pdf.'
        //   ]
        // ]
      ];
      $jenis = $this->request->getPost("jenis_kontrak");
      if (in_array($jenis, ["TRAINING", "KONTRAK"])) {
        $validationRule["tgl_selesai"] = [
          'label' => 'Tanggal Selesai',
          'rules' => 'required'
        ];
      }

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        $allowed_kantor = ['workshop', 'onsite'];
        if (!in_array($kantor, $allowed_kantor)) {
          return $this->response->setJSON(['errors' => ["filedokumen" => "Karyawan tidak valid."]]);
        }
        $jenis = $this->request->getPost("jenis_kontrak");
        $jabatan = ($this->request->getPost("jabatan") == "jabatan-lain")
          ? $this->request->getPost("jabatan_lain")
          : ($this->request->getPost("jabatan") ?? null);
        $tgl_mulai = date("Y-m-d", strtotime($this->request->getPost("tgl_mulai")));
        $tgl_selesai = null;
        if (in_array($jenis, ["TRAINING", "KONTRAK"])) {
          $tgl_selesai_input = $this->request->getPost("tgl_selesai");
          $tgl_selesai = !empty($tgl_selesai_input) ? date("Y-m-d", strtotime($tgl_selesai_input)) : null;
        }

        $file = $this->request->getFile('filedokumen');
        $dokumenName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
          $extension = strtolower($file->getClientExtension());

          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_' . date('YmdHis') . '.' . $extension;

          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_kontrak_' . $kantor;

          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }

          $file->move($uploadPath, $dokumenName);
        }
        // Simpan data ke tabel
        $input_data = [
          "usernuk" => $usernuk,
          "jenis" => $jenis,
          "id_department" => $this->request->getPost("department"),
          "jabatan" => $jabatan,
          "tgl_mulai" => $tgl_mulai,
          "tgl_selesai" => $tgl_selesai,
          "file" => $dokumenName,
        ];

        if ($dokumenName !== null) {
          $input_data["file"] = $dokumenName;
        }


        $data['insert'] = $this->db->table("kontrak")->insert($input_data);
        $id_data = $this->db->insertID();
        // Kategori: 0 Resign, 1 Tetap, 2 Kontrak, 3 Training
        if ($data['insert'] == true) {
          if ($jenis == "TRAINING") {
            $update_status["user_status"] = 3;
          } elseif ($jenis == "KONTRAK") {
            $update_status["user_status"] = 2;
          } else {
            $update_status["user_status"] = 1;
          }
          $update_status["jabatan"] = $jabatan;
          $update_status["id_department"] = $this->request->getPost("department");
          $data['update_karyawan'] = $this->db->table("karyawan")->set($update_status)->where("usernuk", $usernuk)->update();

          $newData = $this->db->table("kontrak")->select("*")->where("id", $id_data)->get()->getRowArray();

          // Gunakan waktu saat ini jika kolom created_at tidak pasti
          $tgl_data = isset($newData["created_at"]) ? date("Y-m-d H:i:s", strtotime($newData["created_at"])) : date("Y-m-d H:i:s");

          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "kontrak",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_kontrak") {
      $validationRule = [
        'usernuk' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'edit_jenis_kontrak' => [
          'label' => 'Jenis',
          'rules' => 'required'
        ],
        'edit_department' => [
          'label' => 'Department',
          'rules' => 'required'
        ],
        'edit_jabatan' => [
          'label' => 'Jabatan',
          'rules' => 'required'
        ],
        'edit_tgl_mulai' => [
          'label' => 'Tanggal Mulai',
          'rules' => 'required'
        ]
      ];
      $jenis = $this->request->getPost("edit_jenis_kontrak");
      if (in_array($jenis, ["TRAINING", "KONTRAK"])) {
        $validationRule["edit_tgl_selesai"] = [
          'label' => 'Tanggal Selesai',
          'rules' => 'required'
        ];
      }

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        $allowed_kantor = ['workshop', 'onsite'];
        if (!in_array($kantor, $allowed_kantor)) {
          return $this->response->setJSON(['errors' => ["edit_filedokumen" => "Karyawan tidak valid."]]);
        }
        $id_data = $this->request->getPost("id_data");
        $datakontrak = $this->db->table("kontrak")->where(["id" => $id_data])->get()->getRowArray();
        $jenis = $this->request->getPost("edit_jenis_kontrak");
        $jabatan = ($this->request->getPost("edit_jabatan") == "jabatan-lain")
          ? $this->request->getPost("jabatan_lain")
          : ($this->request->getPost("edit_jabatan") ?? null);
        $tgl_mulai = date("Y-m-d", strtotime($this->request->getPost("edit_tgl_mulai")));
        $tgl_selesai = null;
        if (in_array($jenis, ["TRAINING", "KONTRAK"])) {
          $tgl_selesai_input = $this->request->getPost("edit_tgl_selesai");
          $tgl_selesai = !empty($tgl_selesai_input) ? date("Y-m-d", strtotime($tgl_selesai_input)) : null;
        }

        $file = $this->request->getFile('edit_filedokumen');
        $dokumenName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {

          $source = WRITEPATH . 'uploads/dokumen_kontrak_' . $kantor . '/' . $datakontrak["file"];

          if (is_file($source)) {
            $trashDir = WRITEPATH . 'uploads/dokumen_kontrak_' . $kantor . '/trash';

            // Buat folder trash jika belum ada
            if (!is_dir($trashDir)) {
              mkdir($trashDir, 0777, true);
            }

            $destination = $trashDir . '/' . $datakontrak["file"];

            // Pindahkan file
            rename($source, $destination);
          }

          $extension = strtolower($file->getClientExtension());

          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_' . date('YmdHis') . '.' . $extension;

          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_kontrak_' . $kantor;

          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }

          $file->move($uploadPath, $dokumenName);

          $data['update_dokumen'] = $this->db->table("kontrak")->set(["file" => $dokumenName])->where("id", $id_data)->update();
        }
        // Simpan data ke tabel

        $update_data = [
          "jenis" => $jenis,
          "id_department" => $this->request->getPost("edit_department"),
          "jabatan" => $jabatan,
          "tgl_mulai" => $tgl_mulai,
          "tgl_selesai" => $tgl_selesai,
        ];

        $data['update'] = $this->db->table("kontrak")->set($update_data)->where("id", $id_data)->update();
        // Kategori: 0 Resign, 1 Tetap, 2 Kontrak, 3 Training
        if ($data['update'] == true) {
          if ($jenis == "TRAINING") {
            $update_status["user_status"] = 3;
          } elseif ($jenis == "KONTRAK") {
            $update_status["user_status"] = 2;
          } else {
            $update_status["user_status"] = 1;
          }
          $update_status["jabatan"] = $jabatan;
          $update_status["id_department"] = $this->request->getPost("edit_department");
          $data['update_karyawan'] = $this->db->table("karyawan")->set($update_status)->where("usernuk", $usernuk)->update();

          $newData = $this->db->table("kontrak")->select("*")->where("id", $id_data)->get()->getRowArray();

          // Gunakan waktu saat ini jika kolom created_at tidak pasti
          $tgl_data = isset($newData["created_at"]) ? date("Y-m-d H:i:s", strtotime($newData["created_at"])) : date("Y-m-d H:i:s");

          $sebelum = json_encode($datakontrak, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "kontrak",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_kontrak") {
      $validationRule = [
        'id' => [
          'label' => 'Data kontrak',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        // Ambil data sebelum dihapus untuk log
        $oldData = $this->db->table("kontrak")->where("id", $id_data)->get()->getRowArray();

        if ($oldData) {
          // Tandai sebagai dihapus (soft delete)
          $data['delete'] = $this->db->table("kontrak")->set(['deleted_at' => date("Y-m-d H:i:s")])->where("id", $id_data)->update();

          if ($data['delete']) {
            // Ambil data terbaru setelah update
            $newData = $this->db->table("kontrak")->where("id", $id_data)->get()->getRowArray();

            // Gunakan updated_at jika tersedia, jika tidak fallback ke sekarang
            $tgl_data = isset($newData['updated_at'])
              ? date("Y-m-d H:i:s", strtotime($newData['updated_at']))
              : date("Y-m-d H:i:s");

            // Log aktifitas
            $data_aktifitas = [
              'nama_tabel' => "kontrak", // gunakan nama tabel lengkap, bukan 'dokumen' saja
              'id_data'    => $id_data,
              'tgl_data'   => $tgl_data,
              'sebelum'    => json_encode($oldData, JSON_UNESCAPED_UNICODE),
              'sesudah'    => json_encode($newData, JSON_UNESCAPED_UNICODE),
              'aktifitas'  => 'delete',
              'created_by' => $biodata['usernuk']
            ];

            $data['log'] = $mlog->save($data_aktifitas);
          }
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_evaluasi") {
      $validationRule = [
        'id_kontrak' => [
          'label' => 'Data kontrak',
          'rules' => 'required',
          'errors' => [
            'required'  => '{field} tidak diketahui.',
          ]
        ],
        'status_evaluasi' => [
          'label' => 'Jenis',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        $id_kontrak = $this->request->getPost("id_kontrak");
        $oldData = $this->db->table("kontrak")->select("*")->where("id", $id_kontrak)->get()->getRowArray();
        $status_evaluasi = $this->request->getPost("status_evaluasi");
        $hasil_evaluasi = $this->request->getPost("hasil_evaluasi") ?? null;
        $update_data = [
          "status_evaluasi" => $status_evaluasi,
          "hasil_evaluasi" => $hasil_evaluasi,
        ];
        $data['update_evaluasi'] = $this->db->table("kontrak")->set($update_data)->where("id", $id_kontrak)->update();
        $file = $this->request->getFile('filedokumen');
        $dokumenName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {

          $extension = strtolower($file->getClientExtension());

          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_evaluasi_' . $id_kontrak . '-' . date('YmdHis') . '.' . $extension;

          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_evaluasi_kontrak_' . $kantor;

          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }

          $file->move($uploadPath, $dokumenName);

          $data['update_dokumen'] = $this->db->table("kontrak")->set(["file_evaluasi" => $dokumenName])->where("id", $id_kontrak)->update();
        }
        if ($data['update_evaluasi']) {
          $newData = $this->db->table("kontrak")->select("*")->where("id", $id_kontrak)->get()->getRowArray();
          $tgl_data = date("Y-m-d H:i:s", strtotime($newData["updated_at"]));
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "karyawan",
            'id_data' => $id_kontrak,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_evaluasi") {
      $validationRule = [
        'id_kontrak' => [
          'label' => 'Data kontrak',
          'rules' => 'required',
          'errors' => [
            'required'  => '{field} tidak diketahui.',
          ]
        ],
        'edit_status_evaluasi' => [
          'label' => 'Jenis',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        $id_kontrak = $this->request->getPost("id_kontrak");
        $oldData = $this->db->table("kontrak")->select("*")->where("id", $id_kontrak)->get()->getRowArray();
        $status_evaluasi = $this->request->getPost("edit_status_evaluasi");
        $hasil_evaluasi = $this->request->getPost("hasil_evaluasi");
        $update_data = [
          "status_evaluasi" => $status_evaluasi,
          "hasil_evaluasi" => $hasil_evaluasi,
        ];
        $data['update_evaluasi'] = $this->db->table("kontrak")->set($update_data)->where("id", $id_kontrak)->update();
        $datakontrak = $this->db->table("kontrak")->where(["id" => $id_kontrak])->get()->getRowArray();
        $file = $this->request->getFile('filedokumen');
        $dokumenName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
          $source = WRITEPATH . 'uploads/dokumen_evaluasi_kontrak_' . $kantor . '/' . $datakontrak["file_evaluasi"];
          if (is_file($source)) {
            $trashDir = WRITEPATH . 'uploads/dokumen_evaluasi_kontrak_' . $kantor . '/trash';

            // Buat folder trash jika belum ada
            if (!is_dir($trashDir)) {
              mkdir($trashDir, 0777, true);
            }

            $destination = $trashDir . '/' . $datakontrak["file_evaluasi"];

            // Pindahkan file
            rename($source, $destination);
          }
          $extension = strtolower($file->getClientExtension());
          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_evaluasi_' . $id_kontrak . '-' . date('YmdHis') . '.' . $extension;
          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_evaluasi_kontrak_' . $kantor;
          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }
          $file->move($uploadPath, $dokumenName);
          $data['update_dokumen'] = $this->db->table("kontrak")->set(["file_evaluasi" => $dokumenName])->where("id", $id_kontrak)->update();
        }
        if ($data['update_evaluasi']) {
          $newData = $this->db->table("kontrak")->select("*")->where("id", $id_kontrak)->get()->getRowArray();
          $tgl_data = date("Y-m-d H:i:s", strtotime($newData["updated_at"]));
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "karyawan",
            'id_data' => $id_kontrak,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_karyawan") {
      $validationRule = [
        'id' => [
          'label' => 'Data karyawan',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        $oldData = $this->db->table("karyawan")->select("*")->where("id", $id_data)->get()->getRowArray();
        $data['delete'] = $this->db->table("karyawan")->set(['deleted_at' => date("Y-m-d H:i:s")])->where(["id" => $id_data])->update();
        if ($data['delete']) {
          $newData = $this->db->table("karyawan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = isset($newData["updated_at"]) ? date("Y-m-d H:i:s", strtotime($newData["updated_at"])) : date("Y-m-d H:i:s");
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "karyawan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "delete",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_pelatihan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'pelatihan' => [
          'label' => 'Pelatihan',
          'rules' => 'required'
        ],
        'tempat' => [
          'label' => 'Tempat Pelatihan',
          'rules' => 'required'
        ],
        'tgl_mulai' => [
          'label' => 'Tanggal Mulai',
          'rules' => 'required'
        ],
        'tgl_selesai' => [
          'label' => 'Tanggal Selesai',
          'rules' => 'required'
        ],
        // 'filedokumen' => [
        //   'label' => 'File Sertifikat',
        //   'rules' => 'uploaded[filedokumen]|max_size[filedokumen,2048]|ext_in[filedokumen,pdf]',
        //   'errors' => [
        //     'uploaded'  => '{field} wajib diunggah.',
        //     'max_size'  => '{field} tidak boleh lebih dari 2MB.',
        //     'ext_in'    => '{field} harus dalam format pdf.'
        //   ]
        // ]
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        $allowed_kantor = ['workshop', 'onsite'];
        if (!in_array($kantor, $allowed_kantor)) {
          return $this->response->setJSON(['errors' => ["filedokumen" => "Karyawan tidak valid."]]);
        }
        $pelatihan = ($this->request->getPost("pelatihan") == "pelatihan-lain")
          ? $this->request->getPost("pelatihan_lain")
          : ($this->request->getPost("pelatihan") ?? null);
        $penyelenggara = ($this->request->getPost("penyelenggara") == "penyelenggara-lain")
          ? $this->request->getPost("penyelenggara_lain")
          : ($this->request->getPost("penyelenggara") ?? null);
        $tempat = ($this->request->getPost("tempat") == "tempat-lain")
          ? $this->request->getPost("tempat_lain")
          : ($this->request->getPost("tempat") ?? null);
        $tgl_mulai = date("Y-m-d", strtotime($this->request->getPost("tgl_mulai")));
        $tgl_selesai = date("Y-m-d", strtotime($this->request->getPost("tgl_selesai")));
        $materi = $this->request->getPost("materi");
        $file = $this->request->getFile('filedokumen');
        $dokumenName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
          $extension = strtolower($file->getClientExtension());

          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_' . date('YmdHis') . '.' . $extension;

          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_pelatihan_' . $kantor;

          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }

          $file->move($uploadPath, $dokumenName);
        }
        // Simpan data ke tabel
        $input_data = [
          "usernuk" => $usernuk,
          "tgl_mulai" => $tgl_mulai,
          "tgl_selesai" => $tgl_selesai,
          "nama" => $pelatihan,
          "penyelenggara" => $penyelenggara,
          "tempat" => $tempat,
          "file" => $dokumenName,
          "link_materi" => $materi,
        ];

        if ($dokumenName !== null) {
          $input_data["file"] = $dokumenName;
        }

        $data['insert'] = $this->db->table("pelatihan")->insert($input_data);
        $id_data = $this->db->insertID();
        if ($data['insert'] == true) {
          $newData = $this->db->table("pelatihan")->select("*")->where("id", $id_data)->get()->getRowArray();
          // Gunakan waktu saat ini jika kolom created_at tidak pasti
          $tgl_data = isset($newData["created_at"]) ? date("Y-m-d H:i:s", strtotime($newData["created_at"])) : date("Y-m-d H:i:s");
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "pelatihan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_pelatihan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'Tahun',
          'rules' => 'required'
        ],
        'edit_pelatihan' => [
          'label' => 'Pelatihan',
          'rules' => 'required'
        ],
        'edit_tempat' => [
          'label' => 'Tempat Pelatihan',
          'rules' => 'required'
        ],
        'edit_tgl_mulai' => [
          'label' => 'Tanggal Mulai',
          'rules' => 'required'
        ],
        'edit_tgl_selesai' => [
          'label' => 'Tanggal Selesai',
          'rules' => 'required'
        ]
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $kantor = strtolower($karyawan["kantor"]);
        $allowed_kantor = ['workshop', 'onsite'];
        if (!in_array($kantor, $allowed_kantor)) {
          return $this->response->setJSON(['errors' => ["edit_filedokumen" => "Karyawan tidak valid."]]);
        }
        $id_data = $this->request->getPost("id_data");
        $datapelatihan = $this->db->table("pelatihan")->where(["id" => $id_data])->get()->getRowArray();
        $pelatihan = ($this->request->getPost("edit_pelatihan") == "pelatihan-lain")
          ? $this->request->getPost("edit_pelatihan_lain")
          : ($this->request->getPost("edit_pelatihan") ?? null);
        $penyelenggara = ($this->request->getPost("edit_penyelenggara") == "penyelenggara-lain")
          ? $this->request->getPost("edit_penyelenggara_lain")
          : ($this->request->getPost("edit_penyelenggara") ?? null);
        $tempat = ($this->request->getPost("edit_tempat") == "tempat-lain")
          ? $this->request->getPost("edit_tempat_lain")
          : ($this->request->getPost("edit_tempat") ?? null);
        $tgl_mulai = date("Y-m-d", strtotime($this->request->getPost("edit_tgl_mulai")));
        $tgl_selesai = date("Y-m-d", strtotime($this->request->getPost("edit_tgl_selesai")));
        $materi = $this->request->getPost("edit_materi");
        $file = $this->request->getFile('edit_filedokumen');
        $dokumenName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {

          $source = WRITEPATH . 'uploads/dokumen_pelatihan_' . $kantor . '/' . $datapelatihan["file"];

          if (is_file($source)) {
            $trashDir = WRITEPATH . 'uploads/dokumen_pelatihan_' . $kantor . '/trash';

            // Buat folder trash jika belum ada
            if (!is_dir($trashDir)) {
              mkdir($trashDir, 0777, true);
            }

            $destination = $trashDir . '/' . $datapelatihan["file"];

            // Pindahkan file
            rename($source, $destination);
          }

          $extension = strtolower($file->getClientExtension());

          // Nama file unik berdasarkan user dan timestamp
          $dokumenName = $usernuk . '_' . date('YmdHis') . '.' . $extension;

          // Path penyimpanan
          $uploadPath = WRITEPATH . 'uploads/dokumen_pelatihan_' . $kantor;

          // Buat folder jika belum ada
          if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
          }

          $file->move($uploadPath, $dokumenName);

          $data['update_dokumen'] = $this->db->table("pelatihan")->set(["file" => $dokumenName])->where("id", $id_data)->update();
        }
        // Simpan data ke tabel
        $update_data = [
          "usernuk" => $usernuk,
          "tgl_mulai" => $tgl_mulai,
          "tgl_selesai" => $tgl_selesai,
          "nama" => $pelatihan,
          "penyelenggara" => $penyelenggara,
          "tempat" => $tempat,
          "link_materi" => $materi,
        ];
        $data['update'] = $this->db->table("pelatihan")->set($update_data)->where("id", $id_data)->update();
        if ($data['update'] == true) {
          $newData = $this->db->table("pelatihan")->select("*")->where("id", $id_data)->get()->getRowArray();
          // Gunakan waktu saat ini jika kolom created_at tidak pasti
          $tgl_data = isset($newData["created_at"]) ? date("Y-m-d H:i:s", strtotime($newData["created_at"])) : date("Y-m-d H:i:s");
          $sebelum = json_encode($datapelatihan, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "pelatihan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_pelatihan") {
      $validationRule = [
        'id' => [
          'label' => 'Data pelatihan',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        // Ambil data sebelum dihapus untuk log
        $oldData = $this->db->table("pelatihan")->where("id", $id_data)->get()->getRowArray();

        if ($oldData) {
          // Tandai sebagai dihapus (soft delete)
          $data['delete'] = $this->db->table("pelatihan")->set(['deleted_at' => date("Y-m-d H:i:s")])->where("id", $id_data)->update();

          if ($data['delete']) {
            // Ambil data terbaru setelah update
            $newData = $this->db->table("pelatihan")->where("id", $id_data)->get()->getRowArray();

            // Gunakan updated_at jika tersedia, jika tidak fallback ke sekarang
            $tgl_data = isset($newData['updated_at'])
              ? date("Y-m-d H:i:s", strtotime($newData['updated_at']))
              : date("Y-m-d H:i:s");

            // Log aktifitas
            $data_aktifitas = [
              'nama_tabel' => "pelatihan", // gunakan nama tabel lengkap, bukan 'dokumen' saja
              'id_data'    => $id_data,
              'tgl_data'   => $tgl_data,
              'sebelum'    => json_encode($oldData, JSON_UNESCAPED_UNICODE),
              'sesudah'    => json_encode($newData, JSON_UNESCAPED_UNICODE),
              'aktifitas'  => 'delete',
              'created_by' => $biodata['usernuk']
            ];

            $data['log'] = $mlog->save($data_aktifitas);
          }
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_pembinaan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'NUK',
          'rules' => 'required'
        ],
        'tanggal' => [
          'label' => 'Tanggal Mulai',
          'rules' => 'required'
        ],
        'jenis' => [
          'label' => 'Jenis Pelanggaran',
          'rules' => 'required'
        ],
        'tindaklanjut' => [
          'label' => 'Tindak Lanjut',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $tanggal = date("Y-m-d", strtotime($this->request->getPost("tanggal")));
        $jenis = $this->request->getPost("jenis") ?? null;
        $tindaklanjut = $this->request->getPost("tindaklanjut") ?? null;
        $catatan = $this->request->getPost("catatan") ?? null;
        $input_data = [
          "usernuk" => $usernuk,
          "tanggal" => $tanggal,
          "jenis" => $jenis,
          "tindak_lanjut" => $tindaklanjut,
          "catatan" => $catatan,
        ];
        $data['insert'] = $this->db->table("pembinaan")->insert($input_data);
        $id_data = $this->db->insertID();
        if ($data['insert']) {
          $newData = $this->db->table("pembinaan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = isset($newData["tanggal"]) ? date("Y-m-d H:i:s", strtotime($newData["tanggal"])) : date("Y-m-d H:i:s");
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "pembinaan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_pembinaan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'NUK',
          'rules' => 'required'
        ],
        'edit_tanggal' => [
          'label' => 'Tanggal Mulai',
          'rules' => 'required'
        ],
        'edit_jenis' => [
          'label' => 'Jenis Pelanggaran',
          'rules' => 'required'
        ],
        'edit_tindaklanjut' => [
          'label' => 'Tindak Lanjut',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id_data");
        $usernuk = $this->request->getPost("usernuk");
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $tanggal = date("Y-m-d", strtotime($this->request->getPost("edit_tanggal")));
        $jenis = $this->request->getPost("edit_jenis") ?? null;
        $tindaklanjut = $this->request->getPost("edit_tindaklanjut") ?? null;
        $catatan = $this->request->getPost("edit_catatan") ?? null;
        $update_data = [
          "usernuk" => $usernuk,
          "tanggal" => $tanggal,
          "jenis" => $jenis,
          "tindak_lanjut" => $tindaklanjut,
          "catatan" => $catatan,
        ];
        $oldData = $this->db->table("pembinaan")->select("*")->where("id", $id_data)->get()->getRowArray();
        $data['update'] = $this->db->table("pembinaan")->set($update_data)->where("id", $id_data)->update();
        if ($data['update']) {
          $newData = $this->db->table("pembinaan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = isset($newData["tanggal"]) ? date("Y-m-d H:i:s", strtotime($newData["tanggal"])) : date("Y-m-d H:i:s");
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "pembinaan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_pembinaan") {
      $validationRule = [
        'id' => [
          'label' => 'Data pelatihan',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        // Ambil data sebelum dihapus untuk log
        $oldData = $this->db->table("pembinaan")->where("id", $id_data)->get()->getRowArray();
        if ($oldData) {
          // Tandai sebagai dihapus (soft delete)
          $data['delete'] = $this->db->table("pembinaan")->set(['deleted_at' => date("Y-m-d H:i:s")])->where("id", $id_data)->update();
          if ($data['delete']) {
            // Ambil data terbaru setelah update
            $newData = $this->db->table("pembinaan")->where("id", $id_data)->get()->getRowArray();

            // Gunakan updated_at jika tersedia, jika tidak fallback ke sekarang
            $tgl_data = isset($newData['tanggal'])
              ? date("Y-m-d H:i:s", strtotime($newData['tanggal']))
              : date("Y-m-d H:i:s");

            // Log aktifitas
            $data_aktifitas = [
              'nama_tabel' => "pembinaan", // gunakan nama tabel lengkap, bukan 'dokumen' saja
              'id_data'    => $id_data,
              'tgl_data'   => $tgl_data,
              'sebelum'    => json_encode($oldData, JSON_UNESCAPED_UNICODE),
              'sesudah'    => json_encode($newData, JSON_UNESCAPED_UNICODE),
              'aktifitas'  => 'delete',
              'created_by' => $biodata['usernuk']
            ];

            $data['log'] = $mlog->save($data_aktifitas);
          }
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "tambah_kesehatan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'NUK',
          'rules' => 'required'
        ],
        'tanggal' => [
          'label' => 'Tanggal',
          'rules' => 'required'
        ],
        'petugas' => [
          'label' => 'Petugas',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $usernuk = $this->request->getPost("usernuk");
        // Get karyawan
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $input_data = [
          "usernuk"           => $usernuk,
          "tanggal"           => date("Y-m-d", strtotime($this->request->getPost("tanggal"))),
          "petugas"           => $this->request->getPost("petugas"),
          "tekanan_darah"     => $this->request->getPost("tekanan_darah"),
          "nadi"              => $this->request->getPost("nadi"),
          "suhu"              => $this->request->getPost("suhu"),
          "tinggi"            => $this->request->getPost("tinggi"),
          "berat"             => $this->request->getPost("berat"),
          "bmi"               => $this->request->getPost("bmi"),
          "gula_darah"        => $this->request->getPost("gula_darah"),
          "kolesterol"        => $this->request->getPost("kolesterol"),
          "asam_urat"         => $this->request->getPost("asam_urat"),
          "fungsi_hati"       => $this->request->getPost("fungsi_hati"),
          "fungsi_ginjal"     => $this->request->getPost("fungsi_ginjal"),
          "hemoglobin"        => $this->request->getPost("hemoglobin"),
          "tes_penglihatan"   => $this->request->getPost("tes_penglihatan"),
          "tes_pendengaran"   => $this->request->getPost("tes_pendengaran"),
          "rontgen"           => $this->request->getPost("rontgen"),
          "catatan"           => $this->request->getPost("catatan"),
          "rekomendasi"       => $this->request->getPost("rekomendasi"),
          "status_fit"        => $this->request->getPost("status_fit"),
        ];
        $data['insert'] = $this->db->table("kesehatan")->insert($input_data);
        $id_data = $this->db->insertID();
        if ($data['insert']) {
          $newData = $this->db->table("kesehatan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = isset($newData["tanggal"]) ? date("Y-m-d H:i:s", strtotime($newData["tanggal"])) : date("Y-m-d H:i:s");
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "kesehatan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sesudah' => $sesudah,
            'aktifitas' => "create",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "update_kesehatan") {
      $validationRule = [
        'usernuk' => [
          'label' => 'NUK',
          'rules' => 'required'
        ],
        'edit_tanggal' => [
          'label' => 'Tanggal',
          'rules' => 'required'
        ],
        'edit_petugas' => [
          'label' => 'Petugas',
          'rules' => 'required'
        ],
      ];

      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id_data");
        $usernuk = $this->request->getPost("usernuk");
        // Get karyawan
        $karyawan = $this->db->table("karyawan")
          ->select("*")
          ->where(["usernuk" => $usernuk])
          ->get()
          ->getRowArray();
        $update_data = [
          "usernuk"           => $usernuk,
          "tanggal"           => date("Y-m-d", strtotime($this->request->getPost("edit_tanggal"))),
          "petugas"           => $this->request->getPost("edit_petugas"),
          "tekanan_darah"     => $this->request->getPost("edit_tekanan_darah"),
          "nadi"              => $this->request->getPost("edit_nadi"),
          "suhu"              => $this->request->getPost("edit_suhu"),
          "tinggi"            => $this->request->getPost("edit_tinggi"),
          "berat"             => $this->request->getPost("edit_berat"),
          "bmi"               => $this->request->getPost("edit_bmi"),
          "gula_darah"        => $this->request->getPost("edit_gula_darah"),
          "kolesterol"        => $this->request->getPost("edit_kolesterol"),
          "asam_urat"         => $this->request->getPost("edit_asam_urat"),
          "fungsi_hati"        => $this->request->getPost("edit_fungsi_hati"),
          "fungsi_ginjal"     => $this->request->getPost("edit_fungsi_ginjal"),
          "hemoglobin"        => $this->request->getPost("edit_hemoglobin"),
          "tes_penglihatan"   => $this->request->getPost("edit_tes_penglihatan"),
          "tes_pendengaran"   => $this->request->getPost("edit_tes_pendengaran"),
          "rontgen"           => $this->request->getPost("edit_rontgen"),
          "catatan"           => $this->request->getPost("edit_catatan"),
          "rekomendasi"       => $this->request->getPost("edit_rekomendasi"),
          "status_fit"        => $this->request->getPost("edit_status_fit"),
        ];
        $oldData = $this->db->table("kesehatan")->select("*")->where("id", $id_data)->get()->getRowArray();
        $data['update'] = $this->db->table("kesehatan")->set($update_data)->where("id", $id_data)->update();
        if ($data['update']) {
          $newData = $this->db->table("kesehatan")->select("*")->where("id", $id_data)->get()->getRowArray();
          $tgl_data = isset($newData["tanggal"]) ? date("Y-m-d H:i:s", strtotime($newData["tanggal"])) : date("Y-m-d H:i:s");
          $sebelum = json_encode($oldData, JSON_UNESCAPED_UNICODE);
          $sesudah = json_encode($newData, JSON_UNESCAPED_UNICODE);
          $data_aktifitas = [
            'nama_tabel' => "kesehatan",
            'id_data' => $id_data,
            'tgl_data' => $tgl_data,
            'sebelum' => $sebelum,
            'sesudah' => $sesudah,
            'aktifitas' => "update",
            'created_by' => $biodata["usernuk"]
          ];
          $data['log'] = $mlog->save($data_aktifitas);
        }
      }
      return $this->response->setJSON($data);
    } elseif ($act == "delete_kesehatan") {
      $validationRule = [
        'id' => [
          'label' => 'Data kesehatan',
          'rules' => 'required'
        ],
      ];
      if (!$this->validate($validationRule)) {
        $notempty = [];
        foreach ($this->request->getPost() as $name => $val) {
          if (!empty($val)) {
            array_push($notempty, $name);
          }
        }
        $data = [
          'notempty' => $notempty,
          'errors' => $this->validator->getErrors()
        ];
      } else {
        $id_data = $this->request->getPost("id");
        // Ambil data sebelum dihapus untuk log
        $oldData = $this->db->table("kesehatan")->where("id", $id_data)->get()->getRowArray();
        if ($oldData) {
          // Tandai sebagai dihapus (soft delete)
          $data['delete'] = $this->db->table("kesehatan")->set(['deleted_at' => date("Y-m-d H:i:s")])->where("id", $id_data)->update();
          if ($data['delete']) {
            // Ambil data terbaru setelah update
            $newData = $this->db->table("kesehatan")->where("id", $id_data)->get()->getRowArray();

            // Gunakan updated_at jika tersedia, jika tidak fallback ke sekarang
            $tgl_data = isset($newData['tanggal'])
              ? date("Y-m-d H:i:s", strtotime($newData['tanggal']))
              : date("Y-m-d H:i:s");

            // Log aktifitas
            $data_aktifitas = [
              'nama_tabel' => "kesehatan", // gunakan nama tabel lengkap, bukan 'dokumen' saja
              'id_data'    => $id_data,
              'tgl_data'   => $tgl_data,
              'sebelum'    => json_encode($oldData, JSON_UNESCAPED_UNICODE),
              'sesudah'    => json_encode($newData, JSON_UNESCAPED_UNICODE),
              'aktifitas'  => 'delete',
              'created_by' => $biodata['usernuk']
            ];

            $data['log'] = $mlog->save($data_aktifitas);
          }
        }
      }
      return $this->response->setJSON($data);
    }
  }

  public function get_data()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $act = $this->request->getGet("act");
    if ($act == "data_karyawan") {
      $kategori = $this->request->getPost("kategori");
      $kantor = preg_replace('/[^a-zA-Z0-9_]/', '', $this->request->getPost("kantor"));
      $where = ["deleted_at" => null];
      $where["k.kantor"] = ucfirst($kantor);
      $builder = $this->db->table("karyawan k")
        ->select("k.*, dept.nama as nama_department")
        ->join("department dept", "dept.id=id_department");

      if ($kategori == "Aktif") {
        $builder->whereIn("user_status", [1, 2, 3]);
      } elseif ($kategori == "Resign") {
        $where["user_status"] = 0;
      } elseif ($kategori == "Tetap") {
        $where["user_status"] = 1;
      } elseif ($kategori == "Kontrak") {
        $where["user_status"] = 2;
      } elseif ($kategori == "Training") {
        $where["user_status"] = 3;
      }

      $datakaryawan = $builder
        ->where($where)
        ->orderBy("reg_date", "asc")
        ->get()
        ->getResultArray();

      $data = [
        "kantor" => $kantor,
        "kategori" => $kategori,
        "datakaryawan" => $datakaryawan
      ];

      return view('hrd/karyawan/table_karyawan', $data);
    } elseif ($act == "pendidikan") {
      $id_data = $this->request->getPost("id");
      $datapendidikan = $this->db->table("pendidikan")->select("*")->where("id", $id_data)->get()->getRowArray();
      $datasekolah    = $this->db->table("pendidikan")->distinct()->select("tempat")->orderBy("tempat", "asc")->get()->getResultArray();
      $datajurusan    = $this->db->table("pendidikan")->distinct()->select("jurusan")->orderBy("jurusan", "asc")->get()->getResultArray();

      $data = [
        "pendidikan"   => $datapendidikan,
        "datasekolah"  => $datasekolah,
        "datajurusan"  => $datajurusan,
      ];

      return $this->response->setJSON($data);
    } elseif ($act == "pekerjaan") {
      $id_data = $this->request->getPost("id");
      $datapekerjaan = $this->db->table("riwayat_kerja")->select("*")->where("id", $id_data)->get()->getRowArray();
      $dataperusahaan =  $this->db->table("riwayat_kerja")->distinct()->select("tempat")->orderBy("tempat", "asc")->get()->getResultArray();
      $datajabatan =  $this->db->table("riwayat_kerja")->distinct()->select("jabatan")->orderBy("jabatan", "asc")->get()->getResultArray();
      $data = [
        "pekerjaan" => $datapekerjaan,
        "dataperusahaan" => $dataperusahaan,
        "datajabatan" => $datajabatan,
      ];
      return $this->response->setJSON($data);
    } elseif ($act == "kontrak") {
      $id = $this->request->getPost("id");
      $kontrak = $this->db->table("kontrak")->select("*")->where(["id" => $id])->get()->getRowArray();
      return $this->response->setJSON($kontrak);
    } elseif ($act == "pelatihan") {
      $id = $this->request->getPost("id");
      $pelatihan = $this->db->table("pelatihan")->select("*")->where(["id" => $id])->get()->getRowArray();
      return $this->response->setJSON($pelatihan);
    } elseif ($act == "pembinaan") {
      $id = $this->request->getPost("id");
      $pembinaan = $this->db->table("pembinaan")->select("*")->where(["id" => $id])->get()->getRowArray();
      return $this->response->setJSON($pembinaan);
    } elseif ($act == "kesehatan") {
      $id = $this->request->getPost("id");
      $kesehatan = $this->db->table("kesehatan")->select("*")->where(["id" => $id])->get()->getRowArray();
      return $this->response->setJSON($kesehatan);
    }
  }

  public function export()
  {
    // Cek session
    if ($this->cek_session() !== true) {
      return $this->cek_session(); // Menghentikan eksekusi dan melakukan redirect
    }
    $act = $this->request->getGet("act");
    if ($act == "data_karyawan") {
      $kategori = $this->request->getGet("kategori");
      $kantor = preg_replace('/[^a-zA-Z0-9_]/', '', $this->request->getGet("kantor"));
      $where = ["deleted_at" => null];
      $where["k.kantor"] = ucfirst($kantor);
      $builder = $this->db->table("karyawan k")
        ->select("k.*, dept.nama as nama_department")
        ->join("department dept", "dept.id=id_department");

      if ($kategori == "Aktif") {
        $builder->whereIn("user_status", [1, 2, 3]);
      } elseif ($kategori == "Resign") {
        $where["user_status"] = 0;
      } elseif ($kategori == "Tetap") {
        $where["user_status"] = 1;
      } elseif ($kategori == "Kontrak") {
        $where["user_status"] = 2;
      } elseif ($kategori == "Training") {
        $where["user_status"] = 3;
      }

      $datakaryawan = $builder
        ->where($where)
        ->orderBy("reg_date", "asc")
        ->get()
        ->getResultArray();

      $data = [
        "kantor" => $kantor,
        "kategori" => $kategori,
        "datakaryawan" => $datakaryawan
      ];
      return view('hrd/karyawan/excel_karyawan.php', $data);
    }
  }
}
