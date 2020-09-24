<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
//$route['mail'] 	= 'EmailController';

$route['default_controller'] 	= 'app';
$route['register'] 				= 'register';
$route['login'] 				= 'login';

$route['404_override'] = 'PageNotFoundController/index';
$route['translate_uri_dashes'] = FALSE;

//Set Splash Screen
$route['setSplashScreen'] 	= 'app/setSplashScreen';
$route['index2'] 	= 'app/index2';



// Membership Plans
$route['viewplans']         = 'app/viewPlans';
$route['plan/(:any)']       = 'app/account/$1';
$route['createAccount']       = 'app/createAccount';

$route['plan/billing/(:any)']       = 'app/billing/$1';
$route['subscribed']       = 'app/subscribed';
$route['pl']       = 'app/subscribeReturnUrl';
$route['success']       = 'app/success';
$route['failure']       = 'app/failure';
$route['processToPayPal']       = 'app/processToPayPal';
$route['plans']       = 'app/getPlans';

$route['admin'] = 'adminDashboard';
$route['admin-login'] = 'adminDashboard/login';
$route['admin-dashboard'] = 'adminDashboard/dashboard/';
$route['admin-logout'] = 'adminDashboard/admin_logout';

// $route['admin'] = 'welcome/index';
$route['all'] 	            = 'app/category';
$route['account'] 	        = 'account';
$route['about'] 	        = 'app/about';
$route['contact'] 	        = 'app/contact';
$route['worksheets'] 	    = 'app/worksheets';

$route['stampToPassport'] = 'app/stampToPassport';
$route['postGems'] = 'app/postGems';

$route['auth/check'] = 'app/checkLogin';

$route['quiz'] = 'app/quiz';
$route['filemanager'] = 'filemanager';
$route['(:any)/explore']    = 'app/explore';
$route['(:any)/explore/(:any)']    = 'app/blog/$1/$2';
$route['(:any)'] 	        = 'app/products/$1';
//$route['all'] 	            = 'category/index';



// Update Children Account
$route['account/update'] = 'account/update';







