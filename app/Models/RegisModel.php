<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisModel extends Model
{

    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['username', 'password'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
