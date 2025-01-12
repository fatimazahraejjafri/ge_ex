<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CompteModel;
use App\Models\RoleModel;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {

        return view('login/login');
    }

    public function auth()
    {
        helper(['form']);
        $session = session();
        $model = new CompteModel();
        $roleModel = new RoleModel();
        $userModel = new UserModel();  // Add model to access the 'user' table
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        // Get user from the 'compte' table based on email
        $user = $model->where('email', $email)->first();
    
        if ($user) {
            // Check if password is valid
            if (password_verify($password, $user['password'])) {
                // Get the id_user from 'compte' and use it to find the 'id_role' in 'user' table
                $userInfo = $userModel->where('id_user', $user['id_user'])->first();  // Get user info from the 'user' table
    
                if ($userInfo) {
                    // Retrieve the role ID from the 'user' table
                    $role = $roleModel->where('id_role', $userInfo['id_role'])->first();  // Look up role by id_role
    
                    if ($role) {
                        // Set session data including role information
                        $sessionData = [
                            'id'        => $user['id_compte'],
                            'email'     => $user['email'],
                            'role'      => $role['name'],  // Replace 'name' with the correct column name from the 'role' table
                            'logged_in' => true
                        ];
                        $session->set($sessionData);
                        $session->setFlashdata('success', 'Connexion réussie.');
    
                        // Redirect based on role
                        if ($role['name'] === 'prof') {  // Replace 'name' with the correct column name
                            return redirect()->to('/dashboard');
                        } else {
                            return redirect()->to('/etudiant');
                        }
                    } else {
                        $session->setFlashdata('error', 'Rôle utilisateur introuvable.');
                    }
                } else {
                    $session->setFlashdata('error', 'Utilisateur non trouvé dans la table des utilisateurs.');
                }
            } else {
                $session->setFlashdata('error', 'Email ou mot de passe invalide.');
            }
        } else {
            $session->setFlashdata('error', 'Utilisateur non trouvé.');
        }
    
        return redirect()->to('/login');
    }
    
    

    public function dashboard()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'prof') {
            return redirect()->to('/login');
        }

        return view('dashbord'); // Replace with the actual view file for the professor dashboard
    }

    public function etudiant()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'etudiant') {
            return redirect()->to('/login');
        }

        return view('etudiant'); // Replace with the actual view file for the student dashboard
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
