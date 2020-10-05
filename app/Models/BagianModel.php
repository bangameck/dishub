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

    public function getBagian($slug = false)
    {
        if ($slug == false) {
            return $this->orderBy('nm_bagian', 'ASC')->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
