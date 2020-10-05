<?php

namespace App\Controllers;

use \App\Models\BidangModel;

class Bagian extends BaseController
{

    protected $bagianModel;


    public function __construct()
    {
        $this->bagianModel = new BagianModel();
        //validasi

    }
    public function index()
    {
        // $user = $this->userModel->findAll();

        $data = [
            'title' => 'Tabel Bidang',
            'bagian' => $this->bagianModel->getBagian(),
        ];

        //dd($user);

        return view('bidang/bidang', $data);
    }
}
