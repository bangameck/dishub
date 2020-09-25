<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function cek_login($u, $p)
    {
        $db_cek = $this->db->table('users');
        $db_cek->where('username', $u);
        $db_cek->where('password', $p);
        $log = $db_cek->get()->getRow();
        return $log;
    }
}
