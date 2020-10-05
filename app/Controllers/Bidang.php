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

    public function save()
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'nm_bidang' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => '{field} harus diisi.',
                ]
            ],
            'initial' => [
                'rules'  => 'required|is_unique[bidang.initial]',
                'errors' => [
                    'required' => '{field} Harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ],
            'foto' => [
                'rules'  => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in'  => 'ekstensi {field} yang diperbolehkan hanya JPG, JPEG, dan PNG',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/user/add')->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/bidang/add'))->withInput();
        }


        //ambil file foto
        $fileFoto = $this->request->getFile('foto');
        //$fileName = $fileFoto->getName();
        $ekstensiFoto = $fileFoto->guessExtension();
        $image = \Config\Services::image();
        if ($fileFoto->getError() == 4) {
            $foto = 'default.png';
        } else {
            $hash = url_title($this->request->getVar('nm_bidang') . '-' . tgl_indo(date('Y-m-d')) . '-' . date('H:i:s'), '-', true);
            $namaFoto = $this->request->getVar('initial') . '-' . $hash;
            //pidahkan file foto
            //$fileFoto->move('_upload/logo', $namaFoto . '.' . $ekstensiFoto);
            //cek Foto
            $foto = $namaFoto . '.' . $ekstensiFoto;
            //membuat thumbnail
            //$file = '_upload/logo/' . $foto;
            $image->withFile($fileFoto)
                ->text('Copyright' . date('Y') . 'Dishub App |' . tgl_indo(date('Y-m-d')), [
                    'color'      => '#0099ff',
                    'opacity'    => 0.1,
                    'withShadow' => true,
                    'hAlign'     => 'center',
                    'vAlign'     => 'middle',
                    'fontSize'   => 20
                ])
                ->resize(500, 400, true, 'height')
                ->save('_upload/logo/' . $foto);
        }

        $slug = url_title($this->request->getVar('initial'), '-', true);
        $data = [
            'nm_bidang'    => $this->request->getVar('nm_bidang'),
            'initial'      => $this->request->getVar('initial'),
            'slug'         => $slug,
            'foto'         => $foto
        ];
        $save =  $this->bidangModel->save($data);
        // dd($data);
        if ($save === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to(base_url('/bidang'));
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to(base_url('/bidang'));
        }
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Halaman Edit Data Bidang',
            'validation' => \Config\Services::validation(),
            'bidang' => $this->bidangModel->getBidang($slug),
        ];
        // dd($data);
        return view('bidang/edit', $data);
    }

    public function update($id_bidang)
    {
        // cek initial lama
        $initialOld = $this->bidangModel->getBidang($this->request->getVar('slug'));
        if ($initialOld['initial'] == $this->request->getVar('initial')) {
            $rule_initial = 'required';
        } else {
            $rule_initial = 'required|is_unique[bidang.initial]';
        }

        if (!$this->validate([
            'initial' => [
                'rules' => $rule_initial,
                'errors' => [
                    'required'  => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada, ganti dengan {field} yang lain.'
                ]
            ],
            'nm_bidang' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi.'
                ]
            ],
            'foto' => [
                'rules'  => 's_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in'  => 'ekstensi {field} yang diperbolehkan hanya JPG, JPEG, dan PNG',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/bidang/edit/' . $this->request->getVar('slug')))->withInput();
        }

        $fileFoto       = $this->request->getFile('foto');
        $ekstensiFoto   = $fileFoto->guessExtension();
        $fotoLama       = $this->request->getVar('fotoLama');
        $image          = \Config\Services::image();
        $bidang         = $this->request->getVar('nm_bidang');
        if ($fileFoto->getError() == 4) {
            $foto = $fotoLama;
        } else {
            $hash = url_title($bidang . '-' . tgl_indo(date('Y-m-d')) . '-' . date('H:i:s'), '-', true);
            $namaFoto = $this->request->getVar('initial') . '-' . $hash;
            //pidahkan file foto
            //$fileFoto->move('_upload/logo', $namaFoto . '.' . $ekstensiFoto);
            $foto = $namaFoto . '.' . $ekstensiFoto;
            $image->withFile($fileFoto)
                ->text('Copyright' . date('Y') . 'Dishub App |' . tgl_indo(date('Y-m-d')), [
                    'color'      => '#0099ff',
                    'opacity'    => 0.1,
                    'withShadow' => true,
                    'hAlign'     => 'center',
                    'vAlign'     => 'middle',
                    'fontSize'   => 20
                ])
                ->resize(500, 400, true, 'height')
                ->save('_upload/logo/' . $foto);
            //hapus foto lama
            if ($fotoLama != 'default.png') {
                unlink('_upload/logo/' . $fotoLama);
            }
        }

        $slug = url_title($this->request->getVar('initial'), '-', true);
        $data = [
            'id_bidang'    => $id_bidang,
            'nm_bidang'    => $this->request->getVar('nm_bidang'),
            'initial'      => $this->request->getVar('initial'),
            'slug'         => $slug,
            'foto'         => $foto
        ];
        $update =  $this->bidangModel->save($data);
        // dd($data);
        if ($update === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to(base_url('/bidang'));
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to(base_url('/bidang'));
        }
    }

    public function hapus($id_bidang)
    {
        $bidang = $this->bidangModel->find($id_bidang);
        $this->bidangModel->delete($id_bidang);
        if ($bidang['foto'] != 'default.png') {
            $path = '_upload/logo/' . $bidang['foto'];
            unlink($path);
        }
        session()->setFlashdata('pesan', 'Data Berhasil di hapus');
        return redirect()->to(base_url('/bidang'));
    }
}
