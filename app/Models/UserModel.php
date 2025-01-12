<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_role', 'id_filiere', 'first_name', 'last_name'];


    public function getStudentsByFiliere($idFiliere) {
        return $this->select('id_user, first_name, last_name')
                    ->where('id_filiere', $idFiliere)
                    ->where('id_role', 1) // Role 1 for students
                    ->findAll();
    }

}
