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
        $musers = new Users();
        $nuk = $this->request->getPost("nuk");
        $password = $this->request->getPost("password");
        $ref = $this->request->getPost("ref");

        $dataUser = $musers->userlogin($nuk);

        if (!empty($dataUser)) {
            // Verifikasi password dengan password_hash
            if ($password == $dataUser['password']) {
                // Set session
                session()->set([
                    'user'      => $dataUser['usernuk'],
                    'level'     => $dataUser['level'],
                    'logged_in' => true
                ]);

                $data['login'] = true;

                // Cek jika ada ref yang dikirim
                if ($ref) {
                    $data['ref'] = base64_decode($ref);
                }
            } else {
                $data['error'] = 'NUK atau Password salah';
            }
        } else {
            $data['error'] = 'NUK atau Password salah';
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
    //         'username' => "0000-000",
    //         'password' => password_hash("12345", PASSWORD_BCRYPT),
    //         'level' => "karyawan",
    //         'id_aol_hja' => 151,
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
