<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		// //validasi
		// if (empty(session()->get('username')) && empty(session()->get('password'))) {
		// 	session()->setFlashdata('pesan', 'Login Terlebih dahulu');
		// 	return redirect()->to('/');
		// }

		$data = [
			'title' => 'Dashboard'
		];
		return view('home/home', $data);
	}
}
