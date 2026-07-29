<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Root & Landing page
$routes->get('/', 'LandingController::index');
$routes->get('/landing', 'LandingController::index');
$routes->get('/rekrutmen-relawan', 'LandingController::rekrutmen');
$routes->get('/laporan-masyarakat', 'LandingController::laporanMasyarakat');

// Public API routes
$routes->post('/api/register-volunteer-request', 'LandingController::storeVolunteerRequest');
$routes->post('/api/store-disaster-report', 'LandingController::storeDisasterReport');

// Authentication routes (Auth namespace)
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::attemptLogin');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::attemptRegister');
$routes->get('/logout', 'Auth\AuthController::logout');
$routes->get('/forbidden', 'Auth\AuthController::forbidden');

// Role-based protected routes: BPBD Admin Command Center (Bpbd namespace)
$routes->get('/bpbd/dashboard', 'Bpbd\DashboardBPBDController::index', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/command-center', 'Bpbd\CommandCenterController::index', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/command-center/get-regencies/(:num)', 'Bpbd\CommandCenterController::getRegencies/$1', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/command-center/get-stats', 'Bpbd\CommandCenterController::getStats', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/bpbd/earthquake-radar', 'Bpbd\EarthquakeRadarController::index', ['filter' => ['auth', 'role:bpbd_admin']]);

// BPBD Posko Management CRUD routes
$routes->get('/bpbd/manage-posko', 'Bpbd\PoskoManagementController::index', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/bpbd/manage-posko/get-regencies/(:num)', 'Bpbd\PoskoManagementController::getRegencies/$1', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/manage-posko/store', 'Bpbd\PoskoManagementController::store', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/manage-posko/update/(:num)', 'Bpbd\PoskoManagementController::update/$1', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/manage-posko/delete/(:num)', 'Bpbd\PoskoManagementController::delete/$1', ['filter' => ['auth', 'role:bpbd_admin']]);

$routes->get('/bpbd/register-relawan', 'Bpbd\VolunteerRegisterController::index', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/register-relawan', 'Bpbd\VolunteerRegisterController::store', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/approval-relawan/approve/(:num)', 'Bpbd\VolunteerRegisterController::approve/$1', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/approval-relawan/reject/(:num)', 'Bpbd\VolunteerRegisterController::reject/$1', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->get('/bpbd/register-psikolog', 'Bpbd\VolunteerRegisterController::psikologPage', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/bpbd/register-psikolog', 'Bpbd\VolunteerRegisterController::storePsikolog', ['filter' => ['auth', 'role:bpbd_admin']]);
$routes->post('/api/register-volunteer-request', 'LandingController::storeVolunteerRequest');
$routes->get('/api/earthquake-data', 'Bpbd\EarthquakeRadarController::fetchBmkgData', ['filter' => ['auth']]);

// Posko detail route (Relawan namespace)
$routes->get('/posko/(:num)', 'Relawan\PoskoController::detail/$1', ['filter' => ['auth']]);
$routes->get('/relawan/posko/(:num)', 'Relawan\RelawanController::posko/$1', ['filter' => ['auth', 'role:relawan']]);

// Victim detail & update routes (Relawan namespace)
$routes->get('/victim/create/(:num)', 'Relawan\VictimController::create/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);
$routes->get('/victim/detail/(:num)', 'Relawan\VictimController::detail/$1', ['filter' => ['auth']]);
$routes->post('/victim/update/(:num)', 'Relawan\VictimController::update/$1', ['filter' => ['auth']]);
$routes->post('/victim/update-psychological/(:num)', 'Relawan\VictimController::updatePsychologicalHistory/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);

// Volunteer Screening routes (Relawan namespace)
$routes->post('/screening/store/(:num)', 'Relawan\ScreeningController::store/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);
$routes->get('/screening/reassess/(:num)', 'Relawan\ScreeningController::reassess/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);
$routes->post('/screening/reassess/(:num)', 'Relawan\ScreeningController::reassess/$1', ['filter' => ['auth', 'role:relawan,psikolog']]);

// Psychologist Mapping & Clinical Workspaces (Psikolog namespace)
$routes->get('/psychologist-mapping', 'Psikolog\PsychologistMappingController::index', ['filter' => ['auth']]);
$routes->get('/psikolog/dashboard', 'Psikolog\PsikologController::index', ['filter' => ['auth', 'role:psikolog']]);

$routes->get('/psychologist-review/(:num)', 'Psikolog\PsychologistReviewController::show/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->post('/psychologist-review/store/(:num)', 'Psikolog\PsychologistReviewController::store/$1', ['filter' => ['auth', 'role:psikolog']]);

$routes->get('/itq/form/(:num)', 'Psikolog\ItqController::form/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->post('/itq/store/(:num)', 'Psikolog\ItqController::store/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->get('/itq/result/(:num)', 'Psikolog\ItqController::result/$1', ['filter' => ['auth', 'role:psikolog']]);
$routes->get('/itq/chart-data/(:num)', 'Psikolog\ItqController::getChartData/$1', ['filter' => ['auth']]);

// Clinical Action route (Psikolog namespace)
$routes->post('/clinical-action/save/(:num)', 'Psikolog\ClinicalActionController::save/$1', ['filter' => ['auth', 'role:psikolog']]);

// Health Check route
$routes->get('/health/database', 'HealthController::database');
