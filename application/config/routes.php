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
$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['admin'] = 'adminDashboard';
$route['admin-login'] = 'adminDashboard/login';
$route['admin-dashboard'] = 'adminDashboard/dashboard/';
$route['admin-logout'] = 'adminDashboard/admin_logout';

// $route['admin'] = 'welcome/index';


////////////////////////STATE MANAGEMENT///////////////////////////	
$route['add-state'] = 'adminStateManagement/add_state';
$route['add-state-details'] = 'adminStateManagement/add_state_details';
$route['state-list'] = 'adminStateManagement/state_list';
$route['edit-state/(:any)'] = 'adminStateManagement/edit_state/$1';
$route['delete-state/(:any)'] = 'adminStateManagement/delete_state/$1';
$route['state-status-change/(:any)/(:any)'] = 'adminStateManagement/stateStatusChange/$1/$2';


$route['add-city'] = 'adminStateManagement/add_city';
$route['add-city-details'] = 'adminStateManagement/add_city_details';
$route['city-list'] = 'adminStateManagement/city_list';
$route['edit-city/(:any)'] = 'adminStateManagement/edit_city/$1';
$route['delete-city/(:any)'] = 'adminStateManagement/delete_city/$1';
$route['city-status-change/(:any)/(:any)'] = 'adminStateManagement/cityStatusChange/$1/$2';







////////////////////////PROFILE MANAGEMENT///////////////////////////	
$route['edit-profile/(:any)'] = 'adminProfile/edit_profile/$1';
$route['view-profile/(:any)'] = 'adminProfile/view_profile/$1';

/////////////////////////USER MANAGEMENT///////////////////////////
$route['users-list'] = 'adminUserManagement/user_list';
$route['edit-user/(:any)'] = 'adminUserManagement/edit_user/$1';
$route['view-user/(:any)'] = 'adminUserManagement/view_user/$1';
$route['login-history-user/(:any)'] = 'adminUserManagement/login_history_user/$1';
$route['delete-user/(:any)'] = 'adminUserManagement/delete_user/$1';
$route['user-status-change/(:any)/(:any)'] = 'adminUserManagement/userStatusChange/$1/$2';
//////////////////////////USER MANAGEMENT///////////////////////////

/////////////////////Change password////////////////////////////
$route['change-password'] = 'adminChangePasswordManagement/change_password';
$route['update-password'] = 'adminChangePasswordManagement/update_password';
//////////////////////Change password////////////////////////////


//////////////////////CATEGORY MANAGEMENT/////////////////////////
$route['add-category'] = 'adminCategoryManagement/add_category';
$route['add-category-details'] = 'adminCategoryManagement/add_category_details';
$route['category-list'] = 'adminCategoryManagement/category_list';
$route['edit-category/(:any)'] = 'adminCategoryManagement/edit_category/$1';
$route['delete-category/(:any)'] = 'adminCategoryManagement/delete_category/$1';


// -------------------- Partner Management --------------------------- //
$route['add-partner'] = 'adminPartner/add_pertner';
$route['add-partner-data'] = 'adminPartner/add_partner_data';
$route['partner-list'] = 'adminPartner/partner_list';
$route['edit-partner/(:any)'] = 'adminPartner/edit_partner/$1';
$route['delete-partner/(:any)'] = 'adminPartner/delete_partner/$1';

/////////////////////////Sub Category/////////////////////////////////////

$route['add-subcategory'] = 'adminSubCategoryManagement/add_subcategory';
$route['add-sub-category-details'] = 'adminSubCategoryManagement/add_sub_category_details';
$route['sub-category-list'] = 'adminSubCategoryManagement/sub_category_list';
$route['edit-sub-category/(:any)'] = 'adminSubCategoryManagement/edit_sub_category/$1';
$route['delete-sub-category/(:any)'] = 'adminSubCategoryManagement/delete_sub_category/$1';




/////////////////////////////PRODUCT  MANAGEMENT////////////////////////////
$route['add-business'] = 'adminProductManagement/add_product';
$route['add-product-details'] = 'adminProductManagement/add_product_details';
$route['business-list'] = 'adminProductManagement/products_list';
$route['edit-business/(:any)'] = 'adminProductManagement/edit_product/$1';
$route['delete-business/(:any)'] = 'adminProductManagement/delete_product/$1';
$route['product-status-change/(:any)/(:any)'] = 'adminProductManagement/productStatusChange/$1/$2';


/////////////////////////////PRODUCT  MANAGEMENT////////////////////////////




/////////////////////////////////Page Management/////////////////////////////
$route['view-page'] = 'adminPageManagement/view_page';
$route['edit-page/(:any)'] = 'adminPageManagement/edit_page/$1';




///////////////////////////Frontend//////////////////////////////////23.6///
$route['home'] = 'home/index';

$route['user-login'] = 'user/login';
$route['user-signup'] = 'user/signup';
$route['user_login_chk'] = 'user/login_chk';
$route['user-logout'] = 'user/user_logout';



//////////////////////////Dashboard(1.7.20)/////////////////////////
$route['user-dashboard'] = 'dashboard/index';

$route['change-password/(:any)'] = 'user/change_password/$1';
$route['update-profile/(:any)'] = 'user/update_profile/$1';



$route['forgot-password'] = 'user/forget_password';
$route['reset-password/(:any)'] = 'user/reset_password/$1';




$route['contact-us'] = 'contactus/contact_us';
$route['contact-form'] = 'contactus/contact_form';

$route['about'] = 'cms/about_us';
$route['privacy-policy'] = 'cms/privacy_policy';
$route['faq'] = 'cms/faq';
$route['partners'] = 'cms/partners';
$route['sitemaps'] = 'cms/sitemaps';
$route['lottery-result'] = 'cms/lottery_result';
$route['popular-category'] = 'cms/popular_category';
$route['category-list/(:any)/(:any)'] = 'cms/category_list/$1/$2';
$route['category-list/(:any)'] = 'cms/category_list/$1';
$route['city-list-business/(:any)/(:any)'] = 'cms/city_list/$1/$2';
$route['city-list-business/(:any)'] = 'cms/city_list/$1';
$route['enlighten-me'] = 'cms/enlightem_me';
$route['white-pages'] = 'cms/white_pages';
$route['map-direction'] = 'cms/map_direction';

$route['state-directory'] = 'stateDirectory/state_directory';
$route['city-list/(:any)'] = 'stateDirectory/city_list/$1';



// $route['forget-password'] = 'user/forget_password';
// $route['forgetpassword-link-send-mail'] = 'user/forget_password_send_mail';

// $route['reset-password/(:any)'] = 'user/reset_password/$1';
// $route['enter-reset-password'] = 'user/update_reset_password';







//////////////////////////////////////LISTING//////////////////////////////////
$route['pro-list'] = 'search/index';
$route['business-search'] = 'search/searches';
$route['business-details/(:any)'] = 'productManagement/viewProductsDetailsById/$1';
$route['fetch-category'] = 'search/fetch_category';
$route['fetch-states-city'] = 'search/fetch_states_city';

$route['business-details/(:any)'] = 'productManagement/viewProductsDetailsById/$1';



////////////////////////////Business////////////////////////////////////
$route['add-business-user'] = 'business/add_business_user';
$route['add-business-user-details'] = 'business/add_business_user_details';
$route['business-user-list'] = 'business/business_user_list';
$route['edit-business-user/(:any)'] = 'business/edit_business_user/$1';
$route['delete-business-user/(:any)'] = 'business/delete_business_user/$1';





////////////////////29.07.20 Arnab////////////////////////

//$route['add-business-user'] = 'business/add_business_user';
//$route['add-business-user-details'] = 'business/add_business_user_details';
//$route['business-user-list'] = 'business/business_user_list';
//$route['edit-business-user/(:any)'] = 'business/edit_business_user/$1';
//$route['delete-business-user/(:any)'] = 'business/delete_business_user/$1';

//$route['city-list-business/(:any)/(:any)'] = 'cms/city_list/$1/$2';
//$route['city-list-business/(:any)'] = 'cms/city_list/$1';

//$route['product-details/(:any)'] = 'productManagement/viewProductsDetailsById/$1';

//$route['login-history-user/(:any)'] = 'adminUserManagement/login_history_user/$1';







