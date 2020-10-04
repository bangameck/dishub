<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id_usr';
    protected $allowedFields = ['no_peg', 'id_usr', 'slug', 'username', 'password', 'nama', 'email', 'level', 'foto'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUser($slug = false)
    {
        if ($slug == false) {
            return $this->orderBy('nama', 'ASC')->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getNopeg()
    {
        $cek_nopeg = $this->db->table('users');
        $cek_nopeg->selectMax('id_usr');
        $no_peg = $cek_nopeg->get()->getRow;
        return $no_peg;
    }
}
