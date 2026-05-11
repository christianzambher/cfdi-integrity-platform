<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/api/health', 'ApiController::health');
$routes->post('/api/xml/validate', 'ApiController::validateXml');