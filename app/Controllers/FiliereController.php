<?php

namespace App\Controllers;

use App\Models\FiliereModel;

class FiliereController extends BaseController {
    public function getFilieresByProf($idProf) {
        $filiereModel = new FiliereModel();
        return $this->response->setJSON($filiereModel->getFilieresByProf($idProf));
    }
}

?>
