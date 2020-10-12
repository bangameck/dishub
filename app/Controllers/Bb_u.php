<?php

namespace App\Controllers;

use \App\Models\BuModel;

class Bb_u extends BaseController
{

    protected $userModel;


    public function __construct()
    {
        $this->buModel = new BuModel();
    }
    public function index()
    {
        // $user = $this->userModel->findAll();
        auth_admin();
        $data = [
            'title' => 'Pilih Nama Anggota',
            'validation' => \Config\Services::validation(),
            'user' => $this->buModel->getUser(),
        ];

        //dd($data);

        return view('user_bidang/user_b', $data);
    }

    public function detail()
    {
        auth_admin();
        $username = $this->request->getVar('username');
        $data = [
            'title' => 'Data Bidang dan Bagian (' . $username . ')',
            'validation' => \Config\Services::validation(),
            'user' => $this->buModel->getUser(),
            'user_bagian' => $this->buModel->getUb($username),
            'username' => $username,
        ];

        // dd($data);

        return view('user_bidang/detail', $data);
    }

    public function add()
    {
        $username = $this->request->getVar('username');
        $data = [
            'title' => 'Halaman Tambah Data Bidang User',
            'validation' => \Config\Services::validation(),
            'user' => $this->buModel->getUser($username),
            'user_bagian' => $this->buModel->getUb($username),
            'bidang' => $this->buModel->getBidang(),
            // 'bagian' => $this->buModel->getBagian(),
        ];
        // dd($data);
        return view('user_bidang/add', $data);
    }

    function get_bagian()
    {
        $id_bidang = $this->request->getVar('id_bidang');
        $data = $this->buModel->getBagian($id_bidang);
        echo json_encode($data);
    }
}
