<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Route mobile
$route['api/auth/proses_login_mobile'] = 'Api/Mobile/AuthControllerMobile/proses_login_mobile';
$route['auth/proses_post_tiketing_mobile'] = 'MobileController/post_tiketing';

$route['default_controller'] = 'WelcomeController';
$route['404_override'] = 'NotFound404';
$route['translate_uri_dashes'] = FALSE;


// Auth Routes
$route['auth'] = 'AuthController/index';
$route['auth/logout'] = 'AuthController/logout';
$route['auth/proses_login'] = 'AuthController/proses_login';

$route['dashboard'] = 'DashboardController';

$route['epermit'] = 'PermitController';
$route['epermit/monitoring_permit'] = 'PermitController/monitoring_permit';
$route['epermit/permit_grafik'] = 'PermitController/permit_grafik';

// Client Routes
$route['main'] = 'MainController';

// Tiketing Routes
$route['tiketing/monitoring_tiketing'] = 'TiketingController/monitoring_tiketing';
$route['tiketing'] = 'TiketingController';
$route['tiketing/submit'] = 'TiketingController/submit_tiketing';
$route['tiketing/view'] = 'TiketingController/view_tiketing';
$route['status_laporan/(:num)'] = 'TiketingController/status_laporan/$1';

// Found Routes
$route['found'] = 'FoundController';
$route['found/submit_found'] = 'FoundController/submit_found';
$route['found/detail_found'] = 'FoundController/detail_penemuan';


// Permit

$route['status_permit'] = 'PermitController/status_permit';


