<?php

namespace App\Models;

use CodeIgniter\Model;

class Settings extends Model
{
  function __construct()
  {
    $this->db = db_connect();
  }

  public function getNotif($kategori)
  {
    $data = $this->db->table("settings_notification")->select("*")->where(["kategori" => $kategori])->get()->getRowArray();
    return $data;
  }

  public function getPenerimaNotif($kategori, $status = null)
  {
    $row = $this->db->table('settings_notification')
      ->where('kategori', $kategori)
      ->get()
      ->getRowArray();
    if (empty($row['datasetting'])) {
      return null;
    }

    $datasetting = json_decode($row['datasetting'], true);
    if ($status == null) {
      return $datasetting['penerima'] ?? null;
    } else {
      $penerima = [];
      foreach ($datasetting['penerima'] as $item) {
        if ($item["status"] == $status) {
          $penerima[] = [
            'nama' => $item["nama"],
            'phone' => $item["phone"],
            'basenotif' => $item["basenotif"],
            'status' => $item["status"],
          ];
        }
      }
      return $penerima ?? null;
    }
  }
}
