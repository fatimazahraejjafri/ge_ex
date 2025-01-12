<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'register::signup');

$routes->get('register', 'register::index');
$routes->post('register', 'register::store');

$routes->get('login', 'Login::index');
$routes->post('login', 'Login::auth');

// Dashboard routes
$routes->get('dashboard', 'Login::dashboard'); // Displays the professor dashboard
$routes->get('etudiant', 'Login::etudiant'); // Displays the student dashboard

$routes->get('filiere/getFilieresByProf/(:num)', 'FiliereController::getFilieresByProf/$1');
$routes->get('module/getModulesByFiliereAndProf/(:num)/(:num)', 'ModuleController::getModulesByFiliereAndProf/$1/$2');
$routes->get('etudiant/getStudentsByFiliere/(:num)', 'EtudiantController::getStudentsByFiliere/$1');
$routes->post('insertGrades', 'NoteController::insertGrades');



$routes->get('login/logout', 'Login::logout');


