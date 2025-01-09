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
$routes->get('dashbord', 'Login::dashboard'); // Displays the professor dashboard
$routes->get('etudiant', 'Login::etudiant'); // Displays the student dashboard

$routes->get('logout', 'Login::logout');

