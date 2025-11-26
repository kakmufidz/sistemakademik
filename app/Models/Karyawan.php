<?php


namespace App\Models;

use CodeIgniter\Model;

class Karyawan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'karyawan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    function __construct()
    {
        $this->db = db_connect();
    }


    public function getWorkshop()
    {
        $dataKaryawan = $this->select("*")->get()->getResultArray();
        return $dataKaryawan;
    }

    public function getOnsite()
    {
        $dataKaryawan = $this->select("*")->get()->getResultArray();
        return $dataKaryawan;
    }

    public function getJabatanInternal()
    {
        // Ambil data jabatan dari tabel karyawan
        $dataJabatankantor = $this->db->table("karyawan")
            ->distinct()
            ->select("jabatan")
            ->get()
            ->getResultArray();

        // Ambil data jabatan dari tabel kontrak
        $dataJabatankontrak = $this->db->table("kontrak")
            ->distinct()
            ->select("jabatan")
            ->get()
            ->getResultArray();

        $allJabatan = array_merge($dataJabatankantor, $dataJabatankontrak);
        $daftarJabatan = array_unique(array_column($allJabatan, 'jabatan'));
        sort($daftarJabatan);
        return $daftarJabatan;
    }

    public function getKontrakHabis($tanggal, $department = "Semua")
    {
        $where = [
            "kr.user_status" => 2,
            "ko.tgl_selesai" => $tanggal,
            "kr.deleted_at" => null,
            "ko.deleted_at" => null
        ];
        if ($department !== "Semua") {
            $where["kr.id_department"] = $department;
        }
        $dataKaryawan = $this->db->table("karyawan kr")->select("kr.usernuk,kr.user_nama_depan,kr.user_nama_belakang,ko.jenis,ko.jabatan,ko.tgl_mulai,ko.tgl_selesai")
            ->join("kontrak ko", "ko.usernuk=kr.usernuk")
            ->where($where)
            ->get()->getResultArray();
        return $dataKaryawan;
    }
}
