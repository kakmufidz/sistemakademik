<?php

namespace App\Models;

use CodeIgniter\Model;

class Notifikasi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'notifikasi';
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
        $this->db = \Config\Database::connect();
    }

    public function getNotifikasi($kategori, $usernuk)
    {
        $notifikasi = $this->select("id, data, read_confirm")
            ->where(["kategori" => $kategori, "target" => "all"])
            ->where("DATE(created_at)", date("Y-m-d"))
            ->orderBy("created_at", "desc")
            ->get()
            ->getRowArray();

        if (!$notifikasi) return null;

        $read_confirm = json_decode($notifikasi["read_confirm"], true) ?? [];
        if (in_array($usernuk, $read_confirm, true)) return null;

        return [
            "id"   => $notifikasi["id"],
            "data" => json_decode($notifikasi["data"], true)
        ];
    }
}
