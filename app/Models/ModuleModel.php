<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model {
    protected $table = 'module';
    protected $primaryKey = 'id_module';
    protected $allowedFields = ['name', 'id_filiere', 'id_user'];

    public function getModulesByFiliereAndProf($idFiliere, $idUser) {
        return $this->where('id_filiere', $idFiliere)
                    ->where('id_user', $idUser)
                    ->findAll();
    }
}
