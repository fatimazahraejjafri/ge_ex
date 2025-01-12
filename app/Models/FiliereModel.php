<?php

namespace App\Models;

use CodeIgniter\Model;

class FiliereModel extends Model
{
    protected $table = 'filiere';
    protected $primaryKey = 'id_filiere';
    protected $allowedFields = ['name'];

    public function getFilieresByProf($idProf) {
        return $this->select('filiere.*')
                    ->join('user', 'filiere.id_filiere = user.id_filiere')
                    ->where('user.id_user', $idProf)
                    ->where('user.id_role', 2) // Role 2 for professors
                    ->findAll();
    }
}
