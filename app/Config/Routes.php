<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Root & Landing page
$routes->get('/', 'LandingController::index');
$routes->get('/landing', 'LandingController::index');

// Authentication routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/forbidden', 'AuthController::forbidden');

// Role-based protected routes: BPBD Admin Command Center
$routes->get('/command-center', 'CommandCenterController::index', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/command-center/get-regencies/(:num)', 'CommandCenterController::getRegencies/$1', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/command-center/get-stats', 'CommandCenterController::getStats', ['filter' => ['auth', 'role:bpbd_admin']]);

// Posko detail route
$routes->get('/posko/(:num)', 'PoskoController::detail/$1', ['filter' => ['auth']]);

// Victim detail & update routes
$routes->get('/victim/create/(:num)', 'VictimController::create/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);
$routes->get('/victim/detail/(:num)', 'VictimController::detail/$1', ['filter' => ['auth']]);
$routes->post('/victim/update/(:num)', 'VictimController::update/$1', ['filter' => ['auth']]);
$routes->post('/victim/update-psychological/(:num)', 'VictimController::updatePsychologicalHistory/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);

// Volunteer Screening routes
$routes->post('/screening/store/(:num)', 'ScreeningController::store/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);
$routes->get('/screening/reassess/(:num)', 'ScreeningController::reassess/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);
$routes->post('/screening/reassess/(:num)', 'ScreeningController::reassess/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);

// Psychologist Mapping & Clinical Workspaces (SEGMEN 9, 10, 11, 12, 13, 14, 15)
$routes->get('/psychologist-mapping', 'PsychologistMappingController::index', ['filter' => ['auth']]);
$routes->get('/psikolog/dashboard', 'PsikologController::index', ['filter' => ['auth', 'role:psikolog']]);
$routes->get('/relawan/posko/(:num)', 'RelawanController::posko/$1', ['filter' => ['auth', 'role:relawan']]);

$routes->get('/psychologist-review/(:num)', 'PsychologistReviewController::show/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->post('/psychologist-review/store/(:num)', 'PsychologistReviewController::store/$1', ['filter' => ['auth', 'role:psikolog']]);

$routes->get('/itq/form/(:num)', 'ItqController::form/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->post('/itq/store/(:num)', 'ItqController::store/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->get('/itq/result/(:num)', 'ItqController::result/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->get('/itq/chart-data/(:num)', 'ItqController::getChartData/$1', ['filter' => ['auth']]);

// Clinical Action route
$routes->post('/clinical-action/save/(:num)', 'ClinicalActionController::save/$1', ['filter' => ['auth', 'role:psikolog']]);
