<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Administrateur

// Client

// Visiteur

$routes->get('/', 'visiteur::accueil');
$routes->match(['get', 'post'], 'seconnecter', 'Visiteur::seconnecter');
$routes->match(['get', 'post'], 'register', 'Visiteur::register');
$routes->match(['get', 'post'], 'sedeconnecter', 'Visiteur::sedeconnecter');
$routes->get('moncompte', 'Visiteur::moncompte');
$routes->match(['get', 'post'], 'modifiermoncompte', 'Visiteur::modifiermoncompte');
$routes->match(['get', 'post'], 'liaisons', 'Visiteur::liaisons');