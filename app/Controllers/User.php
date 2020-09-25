<?php

namespace App\Controllers;

use \App\Models\UserModel;

class User extends BaseController
{

    protected $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
        //validasi

    }
    public function index()
    {
        // $user = $this->userModel->findAll();

        $data = [
            'title' => 'User Page',
            'user' => $this->userModel->getUser(),
        ];

        //dd($user);

        return view('usr/user', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->userModel->getUser($slug),

        ];

        //jika user tida ada
        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User dengan username "' . $slug . '" tidak ditemukan');
        }

        return view('usr/detail', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah User',
        ];
        // dd($data);
        return view('usr/add', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $data = [
            'no_peg'    => $this->request->getVar('no_peg'),
            'slug'      => $slug,
            'username'  => $this->request->getVar('username'),
            'nama'      => $this->request->getVar('nama'),
            'password'  => '12345678',
            'email'     => $this->request->getVar('email'),
            'level'     => $this->request->getVar('level'),
            'foto'      => 'default.png'
        ];
        $save =  $this->userModel->save($data);
        // dd($data);
        if ($save === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to('/user');
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to('/user');
        }
    }
}
