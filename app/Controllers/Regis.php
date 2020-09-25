<?php

namespace App\Controllers;

use \App\Models\RegisModel;

class Regis extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Register | Web Dishub Pku'
        ];
        // $userModel = new UserModel();
        // $user = $userModel->findAll();
        // dd($user);
        return view('regis', $data);
    }

    //--------------------------------------------------------------------

}
