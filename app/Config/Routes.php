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
$routes->match(['get', 'post'], 'tarifs/(:num)', 'Visiteur::tarifs/$1');
$routes->match(['get', 'post'], 'horaires', 'Visiteur::horaires');
$routes->match(['get', 'post'], 'reserver', 'Visiteur::reserver');
$routes->match(['get', 'post'], 'compterendu', 'Visiteur::compterendu');
$routes->match(['get', 'post'], 'historique', 'Visiteur::historique');