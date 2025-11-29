<?php

namespace App\Controllers;

use App\Models\Users;

class Auth extends BaseController
{
    function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
    }


    public function login()
    {
        // Ambil request input dengan cara yang aman
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $ref = $this->request->getPost('ref');

        $data = ['login' => false];
        $userdata = $this->db->table("users")->select("*")->where(["username" => $username])->get()->getRowArray();

        if (!empty($userdata)) {
            // Verifikasi password
            if (password_verify($password, $userdata['password'])) {
                // buat token
                $token = bin2hex(random_bytes(32));

                // Simpan ke sesi
                session()->set([
                    'user' => $userdata['username'],
                    'level' => $userdata['level'],
                    'logged_in' => true
                ]);

                $data['login'] = true;
                $data['token'] = $token; // kirim token ke client

                // Proses referensi jika ada
                if (!empty($ref)) {
                    $data['redirect'] = base64_decode($ref);
                } else {
                    // Sesuaikan redirect berdasarkan level user
                    $data['redirect'] = base_url('dashboard');
                    // if ($userdata['level'] === 'superadmin') {
                    // } else if ($userdata['level'] === 'guru') {
                    //     $data['redirect'] = base_url('dashboard');
                    // } else if ($userdata['level'] === 'siswa') {
                    //     $data['redirect'] = base_url('dashboard');
                    // }
                }
            } else {
                $data['error'] = 'Username atau Password salah';
            }
        } else {
            $data['error'] = 'Username atau Password salah';
        }

        return $this->response->setJSON($data);
    }

    public function logout()
    {
        $array_items = array('user', 'level', 'logged_in');
        $this->session->remove($array_items);
        return redirect()->to(base_url());
    }

    // public function tambah()
    // {
    //     $input = array(
    //         'username' => "superadmin",
    //         'password' => password_hash("superadmin123", PASSWORD_BCRYPT),
    //         'level' => "superadmin",
    //     );
    //     $muser = new Users();
    //     $data['insert'] = $muser->save($input);
    // }

    // public function resetid()
    // {
    //     $data = [];
    //     $data = $this->db->table("karyawan_workshop")
    //         ->select("*")
    //         ->orderBy("id", "asc")
    //         ->get()->getResultArray();
    //     $i = 1;
    //     foreach ($data as $item) {
    //         $update_data = ["id" => $i];
    //         $data["id"] = $item["id"];
    //         $data['proses'] = $this->db->table("karyawan_workshop")->set($update_data)->where("id", $item["id"])->update();
    //         $i++;
    //     }
    //     return $data;
    // }
}
