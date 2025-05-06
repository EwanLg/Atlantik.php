<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Administrateur

// Client

// Visiteur

$routes->get('/', 'visiteur::accueil');
$routes->match(['get', 'post'], 'seconnecter', 'Visiteur::seConnecter');
$routes->match(['get', 'post'], 'register', 'Visiteur::register');