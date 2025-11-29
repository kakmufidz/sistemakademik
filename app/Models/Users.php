<?php

namespace App\Models;

use CodeIgniter\HTTP\Request;
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
        $this->session = session();
        // $this->request = service('request');
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
        $level = $this->session->get('level');
        $username = $this->session->get('username');
        if ($level == "admin") {
            $biodata = [
                "id" => null,
                "username" => $level,
                "jk" => 1,
                "nama" => "Admin",
                "photo" => "admin.svg",
                "user_status" => "1",
            ];
        } elseif ($level == "guru") {
            $biodata = $this->db->table("teachers")
                ->select("*")
                ->where(["username" => $username])->get()->getRowArray();
        } else {
            $biodata = $this->db->table("students")
                ->select("*")
                ->where(["username" => $username])->get()->getRowArray();
        }
        return $biodata;
    }
}
