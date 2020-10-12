<?php

namespace App\Models;

use CodeIgniter\Model;

class BuModel extends Model
{
    protected $table         = 'user_bidang';
    protected $primaryKey    = 'id_ub';
    protected $allowedFields = ['id_ub', 'username', 'id_bidang', 'id_bag', 'jabatan'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUb($username)
    {
        // if ($username == false) {
        //     return $this->select('*, YEAR(users.created_at) as y, MONTH(users.created_at) as m, DAY(users.created_at) as d, bidang.initial as b_inital, bagian.initial as bag_initial, users.foto as u_foto')
        //         ->where(['users.username' => $username])
        //         ->join('users', 'user_bidang.username = users.username')
        //         ->join('bidang', 'user_bidang.id_bidang = bidang.id_bidang')
        //         ->join('bagian', 'user_bidang.id_bagian = bagian.id_bagian')
        //         ->first();;
        // }
        return $this->select('*, YEAR(users.created_at) as y, MONTH(users.created_at) as m, DAY(users.created_at) as d, bidang.initial as b_inital, bagian.initial as bag_initial, users.foto as u_foto')
            ->where(['users.username' => $username])
            ->join('users', 'user_bidang.username = users.username')
            ->join('bidang', 'user_bidang.id_bidang = bidang.id_bidang')
            ->join('bagian', 'user_bidang.id_bagian = bagian.id_bagian')
            ->findAll();
    }

    public function getNopeg()
    {
        $cek_nopeg = $this->db->table('users');
        $cek_nopeg->selectMax('id_usr');
        $no_peg = $cek_nopeg->get()->getRow;
        return $no_peg;
    }

    public function getUser($username = false)
    {
        if ($username == false) {
            return $this->db->table('users')->get()->getResultArray();
        }
        return $this->db->table('users')->where(['username' => $username])
            ->get()->getRowArray();
    }

    public function getBidang()
    {
        return $this->db->table('bidang')->get()->getResultArray();
    }

    public function getBagian($id_bidang)
    {
        //return $this->db->table('bagian')->get()->getResultArray();
        return $this->db->table('bagian')->where(['id_bidang' => $id_bidang])
            ->get()->getResultArray();

        
    }
}
