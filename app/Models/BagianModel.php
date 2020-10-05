<?php

namespace App\Models;

use CodeIgniter\Model;

class BagianModel extends Model
{
    protected $table         = 'bagian';
    protected $primaryKey    = 'id_bagian';
    protected $allowedFields = ['id_bagian', 'id_bidang', 'nm_bagian', 'initial', 'slug', 'foto'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // public function getBagian($slug = false)
    // {
    //     if ($slug == false) {
    //         return $this->orderBy('nm_bagian', 'ASC')->findAll();
    //     }

    //     return $this->where(['slug' => $slug])->first();

    // }

    public function getBagian($b_slug = false)
    {
        // if ($slug == false) {
        //     return $this->db->table('bagian')
        //         ->select('*, bagian.initial as b_initial, bagian.foto as b_foto')
        //         ->join('bidang', 'bidang.id_bidang = bagian.id_bidang')
        //         ->orderBy('bagian.nm_bagian', 'ASC')
        //         ->get()->getResultArray();
        // }
        // return $this->db->table('bagian')
        //     ->select('*, bagian.initial as b_initial, bagian.foto as b_foto')
        //     ->where(['bagian.slug' => $slug])
        //     ->join('bidang', 'bidang.id_bidang = bagian.id_bidang')
        //     ->orderBy('bagian.nm_bagian', 'ASC')
        //     ->get()->getResultArray();
        if ($b_slug == false) {
            return $this->select('*, bagian.slug as b_slug, bagian.initial as b_initial, bagian.foto as b_foto')
                ->join('bidang', 'bidang.id_bidang = bagian.id_bidang')
                ->findAll();
        }
        return $this->select('*, bagian.slug as b_slug, bagian.initial as b_initial, bagian.foto as b_foto')
            ->where(['bagian.slug' => $b_slug])
            ->join('bidang', 'bidang.id_bidang = bagian.id_bidang')
            ->first();
    }
    public function getBidang()
    {
        return $this->db->table('bidang')->get()->getResultArray();
    }
}
