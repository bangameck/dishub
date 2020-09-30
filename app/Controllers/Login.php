<?php

namespace App\Controllers;

use \App\Models\LoginModel;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->LoginModel = new LoginModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login | Web Dishub Pku',
            'validation' => \Config\Services::validation(),
        ];
        // $userModel = new UserModel();
        // $user = $userModel->findAll();
        // dd($user);
        return view('login', $data);
    }

    public function auth()
    {
        //pengambilan data dari form
        //dd($this->request->getVar());
        $loginModel = new LoginModel;

        $u = $this->request->getVar('username');
        $p = $this->request->getVar('password');

        //cek keDB
        $cek = $loginModel->cek_login($u, $p);

        if ($cek == null) {
            session()->setFlashdata('pesan', 'Username anda salah');
            return redirect()->to('/')->withInput();
        }
        if ($p == password_verify($p, $cek->password)) {
            $data = [
                'nama' => $cek->nama,
                'username' => $cek->username,
                'password' => $cek->password,
                'email' => $cek->email,
                'level' => $cek->level,
                'foto' => $cek->foto,
            ];
            session()->set($data);
            if ($data['level'] == 1) {
                session()->setFlashdata('pesan', 'Berhasil Login, Selamat datang dihalaman admin');
                return redirect()->to(base_url('home'));
            } else  if ($data['level'] == 2) {
                session()->setFlashdata('pesan', 'Berhasil Login, Selamat datang dihalaman Kepala');
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('pesan', 'Berhasil Login, Selamat datang dihalaman Pegawai');
                return redirect()->to(base_url('home'));
            }
        } else {
            session()->setFlashdata('pesan', 'Password Salah..');
            return redirect()->to('/')->withInput();
        }
    }
    // redirect ke halaman masing2
    //     if (($cek['username'] == $u) && ($cek['password'] == $p)) {
    //         //jika berhasil
    //         session()->set('nama', $cek['nama']);
    //         session()->set('username', $cek['username']);
    //         session()->set('password', $cek['password']);
    //         session()->set('level', $cek['level']);
    //         if ($cek['level'] == 1) {
    //             return redirect()->to(base_url('home'));
    //         } else if ($cek['level'] == 2) {
    //             return redirect()->to(base_url('home/kepala'));
    //         } else {
    //             return redirect()->to(base_url('home/pegawai'));
    //         }
    //     } else {
    //         //jika gagal
    //         session()->setFlashdata('gagal', 'username dan password salah.');
    //         return redirect()->to(base_url('/'));
    //     }
    // }

    public function out()
    {
        session()->setTempdata('username');
        session()->setTempdata('password');
        session()->setTempdata('email');
        session()->setTempdata('level');
        session()->setTempdata('foto');
        session()->setFlashdata('out', 'Anda Berhasil Logout..');
        return redirect()->to('/');
    }
}
