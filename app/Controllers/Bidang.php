<?php

namespace App\Controllers;

use \App\Models\BidangModel;

class Bidang extends BaseController
{

    protected $bidangModel;


    public function __construct()
    {
        $this->bidangModel = new BidangModel();
        //validasi

    }
    public function index()
    {
        // $user = $this->userModel->findAll();

        $data = [
            'title' => 'Tabel Bidang',
            'bidang' => $this->bidangModel->getBidang(),
        ];

        //dd($user);

        return view('bidang/bidang', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Halaman Tambah Data Bidang',
            'validation' => \Config\Services::validation(),
        ];
        // dd($data);
        return view('bidang/add', $data);
    }
}
