<?php

namespace App\Controllers;

use App\Models\NoteModel;
use CodeIgniter\Controller;

class NoteController extends Controller
{
    protected $noteModel;

    public function __construct()
    {
        $this->noteModel = new NoteModel();
    }

    public function insertGrades()
    {
        $moduleId = $this->request->getPost('id_module');
        $grades = json_decode($this->request->getPost('grades'), true); // Décoder le JSON

        if (!$moduleId || empty($grades)) {
            return $this->response->setJSON(['error' => 'Données invalides.']);
        }

        // Insertion des notes
        foreach ($grades as $gradeData) {
            $studentId = $gradeData['id_user'];
            $grade = $gradeData['grade'];

            $existing = $this->noteModel->where(['id_module' => $moduleId, 'id_user' => $studentId])->first();
            if ($existing) {
                // Mettre à jour la note existante
                $this->noteModel->update($existing['id_note'], ['grade' => $grade]);
            } else {
                // Insérer une nouvelle note
                $this->noteModel->insert([
                    'id_module' => $moduleId,
                    'id_user' => $studentId,
                    'grade' => $grade
                ]);
            }
        }

        return $this->response->setJSON(['success' => 'Notes enregistrées avec succès.']);
    }
}
