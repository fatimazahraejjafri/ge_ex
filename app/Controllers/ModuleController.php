<?php

namespace App\Controllers;

use App\Models\ModuleModel;

class ModuleController extends BaseController {
    public function getModulesByFiliereAndProf($idFiliere, $idUser) {
        $moduleModel = new ModuleModel();
        return $this->response->setJSON($moduleModel->getModulesByFiliereAndProf($idFiliere, $idUser));
    }
}


?>