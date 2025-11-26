<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if ($this->session->get('logged_in') == true)  return redirect()->to(base_url('dashboard'));
        $data = ['page_title' => "HRIS Harapan Jaya"];
        return view('login', $data);
    }
}
