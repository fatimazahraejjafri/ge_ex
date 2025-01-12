<?php

namespace App\Controllers;

use App\Models\UserModel;

class EtudiantController extends BaseController {
    public function getStudentsByFiliere($idFiliere) {
        $userModel = new UserModel();
        $students = $userModel->getStudentsByFiliere($idFiliere);
        
        if (empty($students)) {
            return $this->response->setJSON([]); // Return an empty array if no students
        }

        return $this->response->setJSON($students);
    }
}

?>