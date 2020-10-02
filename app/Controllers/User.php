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
            'title' => 'Tabel User',
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
            ],
            'level' => [
                'rules'  => 'decimal',
                'errors' => [
                    'decimal' => '{field} Harus diisi.'
                ]
            ],
            'foto' => [
                'rules'  => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran maksimal file {field} tidak boleh lebih dari 1 MB.',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in'  => 'ekstensi {field} yang diperbolehkan hanya JPG, JPEG, dan PNG',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/user/add')->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/user/add'))->withInput();
        }


        //ambil file foto
        $fileFoto = $this->request->getFile('foto');
        $ekstensiFoto = $fileFoto->guessExtension();
        if ($fileFoto->getError() == 4) {
            $foto = 'default.png';
        } else {
            $hash = url_title(tgl_indo(date('Y-m-d')) . '-' . date('H:i:s'), '-', true);
            $namaFoto = $this->request->getVar('no_peg') . '-' . $this->request->getVar('username') . '-' . $hash;
            //pidahkan file foto
            $fileFoto->move('_upload/f_usr', $namaFoto . '.' . $ekstensiFoto);
            //cek Foto
            $foto = $namaFoto . '.' . $ekstensiFoto;
        }

        $slug = url_title($this->request->getVar('username'), '-', true);
        $data = [
            'no_peg'    => $this->request->getVar('no_peg'),
            'slug'      => $slug,
            'username'  => $this->request->getVar('username'),
            'nama'      => $this->request->getVar('nama'),
            'password'  => password_hash('12345678', PASSWORD_DEFAULT),
            'email'     => $this->request->getVar('email'),
            'level'     => $this->request->getVar('level'),
            'foto'      => $foto
        ];
        $save =  $this->userModel->save($data);
        // dd($data);
        if ($save === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to(base_url('/user'));
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to(base_url('/user'));
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
        // cek username lama
        $userOld = $this->userModel->getUser($this->request->getVar('slug'));
        if ($userOld['username'] == $this->request->getVar('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|is_unique[users.username]';
        }
        //cek email lama
        if ($userOld['email'] == $this->request->getVar('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[users.email]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $rule_username,
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
                'rules' => $rule_email,
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ],
            'foto' => [
                'rules'  => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran maksimal file {field} tidak boleh lebih dari 1 MB.',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in'  => 'ekstensi {field} yang diperbolehkan hanya JPG, JPEG, dan PNG',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/user/edit/' . $this->request->getVar('slug')))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');
        $ekstensiFoto = $fileFoto->guessExtension();
        $fotoLama = $this->request->getVar('fotoLama');
        if ($fileFoto->getError() == 4) {
            $foto = $fotoLama;
        } else {
            $hash = url_title(tgl_indo(date('Y-m-d')) . '-' . date('H:i:s'), '-', true);
            $namaFoto = $this->request->getVar('no_peg') . '-' . $this->request->getVar('username') . '-' . $hash;
            //pidahkan file foto
            $fileFoto->move('_upload/f_usr', $namaFoto . '.' . $ekstensiFoto);
            //hapus foto lama
            if ($fotoLama != 'default.png') {
                unlink('_upload/f_usr/' . $fotoLama);
            }

            //cek Foto
            $foto = $namaFoto . '.' . $ekstensiFoto;
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
            'foto'      => $foto
        ];
        $update =  $this->userModel->save($data);
        // dd($data);
        if ($update === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to(base_url('/user'));
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to(base_url('/user'));
        }
    }

    public function hapus($id)
    {
        $user = $this->userModel->find($id);
        $this->userModel->delete($id);
        if ($user['foto'] != 'default.png') {
            unlink('_upload/f_usr/' . $user['foto']);
        }
        session()->setFlashdata('pesan', 'Data Berhasil di hapus');
        return redirect()->to(base_url('/user'));
    }
}
