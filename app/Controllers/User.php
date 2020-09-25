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
            'title' => 'Halaman Tambah Data User',
            'validation' => \Config\Services::validation(),
        ];
        // dd($data);
        return view('usr/add', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ],
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/add')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('username'), '-', true);
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

    public function edit($slug)
    {
        $data = [
            'title' => 'Halaman Edit Data User',
            'validation' => \Config\Services::validation(),
            'user' => $this->userModel->getUser($slug),
        ];
        // dd($data);
        return view('usr/edit', $data);
    }

    public function update($id_usr)
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ],
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/edit/' . $this->request->getVar('slug') . '')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('username'), '-', true);
        $data = [
            'id_usr'    => $id_usr,
            'no_peg'    => $this->request->getVar('no_peg'),
            'slug'      => $slug,
            'username'  => $this->request->getVar('username'),
            'nama'      => $this->request->getVar('nama'),
            // 'password'  => '12345678',
            'email'     => $this->request->getVar('email'),
            'level'     => $this->request->getVar('level'),
            'foto'      => 'default.png'
        ];
        $update =  $this->userModel->update($data);
        // dd($data);
        if ($update === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to('/user');
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to('/user');
        }
    }

    public function hapus($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil di hapus');
        return redirect()->to('/user');
    }
}
