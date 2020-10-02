<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table         = 'bidang';
    protected $primaryKey    = 'id_bidang';
    protected $allowedFields = ['id_bidang', 'nm_bidang', 'initial', 'slug', 'foto'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBidang($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
