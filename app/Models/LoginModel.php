<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    public function cek_login($u)
    {
        $db_cek = $this->db->table('users');
        $db_cek->where('username', $u);
        $log = $db_cek->get()->getRow();
        return $log;
    }
}
