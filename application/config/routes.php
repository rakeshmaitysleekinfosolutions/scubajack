<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] 	= 'app';
$route['register'] 				= 'register';
$route['login'] 				= 'login';

$route['404_override'] = 'PageNotFoundController/index';
$route['translate_uri_dashes'] = FALSE;

//Set Splash Screen
$route['setSplashScreen'] 	= 'app/setSplashScreen';
$route['index2'] 	        = 'app/index2';
// Membership Plans
$route['viewplans']         = 'app/viewPlans';
$route['plan/(:any)']       = 'app/account/$1';
$route['plan/(:any)/billing']       = 'app/billing/$1';



$route['all'] 	            = 'app/category';
$route['account'] 	        = 'account';
$route['about'] 	        = 'app/about';
$route['contact'] 	        = 'app/contact';

$route['(:any)/explore']    = 'app/explore';
$route['(:any)'] 	        = 'app/products/$1';
//$route['all'] 	            = 'category/index';

// Update Children Account
$route['account/update'] = 'account/update';


$route['admin'] = 'adminDashboard';
$route['admin-login'] = 'adminDashboard/login';
$route['admin-dashboard'] = 'adminDashboard/dashboard/';
$route['admin-logout'] = 'adminDashboard/admin_logout';



// $route['forget-password'] = 'user/forget_password';
// $route['forgetpassword-link-send-mail'] = 'user/forget_password_send_mail';

// $route['reset-password/(:any)'] = 'user/reset_password/$1';
// $route['enter-reset-password'] = 'user/update_reset_password';



