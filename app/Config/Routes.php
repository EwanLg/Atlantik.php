<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Administrateur

// Client

// Visiteur

$routes->get('atlantik', 'visiteur::accueil');
$routes->match(['get', 'post'], 'seconnecter', 'Visiteur::seConnecter');