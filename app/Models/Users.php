<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
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

    public function userlogin($nuk)
    {
        $userdata = $this->select("*")->where(["username" => $nuk])->get()->getRowArray();
        return $userdata;
    }

    public function user($nuk)
    {
        $userdata = $this->select("*")->where(["username" => $nuk])->get()->getRowArray();
        $biodata = $this->db->table("karyawan")->select("*")->where(["username" => $nuk])->get()->getRowArray();
        $biodata["password"] = $userdata["password"];
        $biodata["level"] = $userdata["level"];
        return $biodata;
    }

    public function biodata()
    {
        $level = $_SESSION['level'];
        $user = $_SESSION['user'];
        if ($user == "superdede") {
            $biodata = [
                "user_id" => null,
                "nuk" => $level,
                "user_nama_depan" => "Super",
                "user_nama_belakang" => "Admin",
                "id_departemen" => "10",
                "nama_departemen" => "Superadmin",
                "departemen" => "Superadmin",
                "jk" => "1",
                "no_telp" => null,
                "photo" => "avatar-man.svg",
                "user_status" => "1",
                "reg_date" => "1988-01-01",
                "resign_date" => null,
            ];
        } elseif ($user == "direksi") {
            $biodata = [
                "user_id" => null,
                "nuk" => $level,
                "user_nama_depan" => "Direksi",
                "user_nama_belakang" => "",
                "id_departemen" => "7",
                "nama_departemen" => "Direksi",
                "departemen" => "Direksi",
                "jk" => "1",
                "no_telp" => null,
                "photo" => "avatar-man.svg",
                "user_status" => "1",
                "reg_date" => "1988-01-01",
                "resign_date" => null
            ];
        } else {
            $biodata = $this->db->table("karyawan k")
                ->select("k.*,d.nama as nama_department")
                ->join("department d", "d.id=k.id_department")
                ->where(["username" => $user])->get()->getRowArray();
        }
        return $biodata;
    }
}
