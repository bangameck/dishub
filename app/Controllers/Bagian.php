<?php

namespace App\Controllers;

use \App\Models\BagianModel;

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
            'title'  => 'Tabel Bagian',
            'bagian' => $this->bagianModel->getBagian(),
        ];

        //dd($data);

        return view('bagian/bagian', $data);
    }

    public function detail($b_slug)
    {
        $data = [
            'title' => 'Detail Bagian',
            'bagian' => $this->bagianModel->getBagian($b_slug),

        ];

        //jika user tida ada
        if (empty($data['bagian'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Bagian "' . $b_slug . '" tidak ditemukan');
        }

        return view('bagian/detail', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Halaman Tambah Data Bagian',
            'validation' => \Config\Services::validation(),
            'bidang' => $this->bagianModel->getBidang(),
        ];
        //dd($data['bidang']);
        return view('bagian/add', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'nm_bagian' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'form tidak boleh kosong.',
                ]
            ],
            'nm_bidang' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'form tidak boleh kosong.',
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
            return redirect()->to(base_url('/bagian/add'))->withInput();
        }


        //ambil file foto
        $fileFoto = $this->request->getFile('foto');
        //$fileName = $fileFoto->getName();
        $ekstensiFoto = $fileFoto->guessExtension();
        $image = \Config\Services::image();
        if ($fileFoto->getError() == 4) {
            $foto = 'default.png';
        } else {
            $hash = url_title($this->request->getVar('nm_bagian') . '-' . tgl_indo(date('Y-m-d')) . '-' . date('H:i:s'), '-', true);
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
                    'vAlign'     => 'bottom',
                    'fontSize'   => 20
                ])
                ->resize(500, 400, true, 'height')
                ->save('_upload/logo/' . $foto);
        }

        $slug = url_title($this->request->getVar('initial'), '-', true);
        $data = [
            'id_bidang'    => $this->request->getVar('nm_bidang'),
            'nm_bagian'    => $this->request->getVar('nm_bagian'),
            'initial'      => $this->request->getVar('initial'),
            'slug'         => $slug,
            'foto'         => $foto
        ];
        $save =  $this->bagianModel->save($data);
        // dd($data);
        if ($save === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to(base_url('/bagian'));
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to(base_url('/bagian'));
        }
    }

    public function edit($b_slug)
    {
        $data = [
            'title' => 'Halaman Edit Data Bidang',
            'validation' => \Config\Services::validation(),
            'bagian' => $this->bagianModel->getBagian($b_slug),
            'bidang' => $this->bagianModel->getBidang(),
        ];
        // dd($data);
        return view('bagian/edit', $data);
    }

    public function update($id_bagian)
    {
        // cek initial lama
        $initialOld = $this->bagianModel->getBagian($this->request->getVar('slug'));
        if ($initialOld['initial'] == $this->request->getVar('initial')) {
            $rule_initial = 'required';
        } else {
            $rule_initial = 'required|is_unique[bidang.initial]';
        }

        if (!$this->validate([
            'nm_bagian' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'form tidak boleh kosong.',
                ]
            ],
            'nm_bidang' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'form tidak boleh kosong.',
                ]
            ],
            'initial' => [
                'rules' => $rule_initial,
                'errors' => [
                    'required'  => '{field} harus diisi.',
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
            return redirect()->to(base_url('/bagian/edit/' . $this->request->getVar('slug')))->withInput();
        }

        $fileFoto       = $this->request->getFile('foto');
        $ekstensiFoto   = $fileFoto->guessExtension();
        $fotoLama       = $this->request->getVar('fotoLama');
        $image          = \Config\Services::image();
        $bagian         = $this->request->getVar('nm_bagian');
        if ($fileFoto->getError() == 4) {
            $foto = $fotoLama;
        } else {
            $hash = url_title($bagian . '-' . tgl_indo(date('Y-m-d')) . '-' . date('H:i:s'), '-', true);
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
                    'vAlign'     => 'bottom',
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
            'id_bagian'    => $id_bagian,
            'id_bidang'    => $this->request->getVar('nm_bidang'),
            'nm_bagian'    => $this->request->getVar('nm_bagian'),
            'initial'      => $this->request->getVar('initial'),
            'slug'         => $slug,
            'foto'         => $foto
        ];
        $update =  $this->bagianModel->save($data);
        // dd($data);
        if ($update === true) {
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to(base_url('/bagian'));
        } else {
            session()->setFlashdata('pesan_gagal', 'Data Gagal disimpan');
            return redirect()->to(base_url('/bagian'));
        }
    }

    public function hapus($id_bagian)
    {
        $bagian = $this->bagianModel->find($id_bagian);
        $this->bagianModel->delete($id_bagian);
        if ($bagian['foto'] != 'default.png') {
            $path = '_upload/logo/' . $bagian['foto'];
            unlink($path);
        }
        session()->setFlashdata('pesan', 'Data Berhasil di hapus');
        return redirect()->to(base_url('/bagian'));
    }
}
