<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'WelcomeController';

$route['404_override'] = 'NotFound404';
$route['translate_uri_dashes'] = FALSE;

// Auth Routes
$route['auth/login'] = 'AuthController';
$route['logout'] = 'AuthController/logout';


// Admin Routes
$route['dashboard'] = 'DashboardController';

$route['epermit'] = 'PermitController';
$route['epermit/monitoring_permit'] = 'PermitController/monitoring_permit';
$route['epermit/permit_grafik'] = 'PermitController/permit_grafik';

// Client Routes
$route['main'] = 'MainController';

