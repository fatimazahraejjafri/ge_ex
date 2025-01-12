<?php

namespace App\Models;

use CodeIgniter\Model;

<<<<<<< HEAD



=======
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
class NoteModel extends Model
{
    protected $table = 'note';
    protected $primaryKey = 'id_note';
    protected $allowedFields = ['id_module', 'id_user', 'grade'];

<<<<<<< HEAD
}
=======
    public function saveMultipleNotes($moduleId, $grades, $filiereId)
    {
        // Récupérer les étudiants (users) en fonction de la filière
        $userModel = new \App\Models\UserModel();
        $students = $userModel->where('id_filiere', $filiereId)->findAll(); // Remplacez 'id_filiere' par le champ correct si nécessaire

        foreach ($students as $student) {
            // Vérifier si un étudiant a une note déjà enregistrée pour ce module
            $existing = $this->where(['id_module' => $moduleId, 'id_user' => $student['id_user']])->first();
            $grade = isset($grades[$student['id_user']]) ? $grades[$student['id_user']] : null;

            if ($grade !== null) {
                if ($existing) {
                    // Mettre à jour la note existante
                    $this->update($existing['id_note'], ['grade' => $grade]);
                } else {
                    // Insérer une nouvelle note
                    $this->insert([
                        'id_module' => $moduleId,
                        'id_user' => $student['id_user'],
                        'grade' => $grade
                    ]);
                }
            }
        }
        return true;
    }
}
>>>>>>> ef5019b065249b84255fd2345db4bede388fb09f
