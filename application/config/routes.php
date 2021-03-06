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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'Form_register';

// API ROUTES
$route['api/auth/login'] = 'API/authAPI';
$route['api/auth/register'] = 'API/registerAPI';

// WEB ROUTES
$route['master/institution/detail/:num'] = 'Master/detail_institution';
$route['master/company/detail/:num'] = 'Master/detail_company';
$route['master/buy'] = 'Master/buy';
$route['product'] = 'Home/product';
$route['product/add'] = 'Home/product_add';

$route['history'] = 'Transaction/history';
$route['transaction/detail/:num'] = 'Transaction/detail';
$route['invoice/cetak/:num'] = 'Transaction/cetak';
$route['form-register'] = 'Form_Register';

// API TRANSACTIONS
$route['api/transaction/create'] = 'Transaction/create';
$route['api/transaction/payment'] = 'Transaction/confirm_payment';
$route['api/transaction/status'] = 'Transaction/update_status';

// API USER
$route['api/product/add/myproduct'] = 'Home/add_product';
$route['product/delete/(:num)'] = 'Home/delete_product/$1';
$route['product/detail/:num'] = 'Home/detail_product';


// Institution Master Endpoint
$route['api/institution/all'] = 'API/getInstitutionAPI';
$route['api/master/add/institution'] = 'Master/add_institution';
$route['api/master/get/institution/:num'] = 'Master/get_institution';
$route['api/master/update/institution'] = 'Master/update_institution';
$route['api/master/delete/institution/:num'] = 'Master/delete_institution';

// Company Master Endpoint
$route['api/company/all'] = 'API/getCompanyAPI';
$route['api/master/add/company'] = 'Master/add_company';
$route['api/master/get/company/:num'] = 'Master/get_company';
$route['api/master/update/company'] = 'Master/update_company';
$route['api/master/delete/company/:num'] = 'Master/delete_company';

// Product Master Endpoint
$route['api/product/all'] = 'API/getProductAPI';
$route['api/master/add/product'] = 'Master/add_product';
$route['api/master/get/product/:num'] = 'Master/get_product';
$route['api/master/update/product'] = 'Master/update_product';
$route['api/master/delete/product/:num'] = 'Master/delete_product';

// User Master Endpoint
$route['api/master/get/user/:num'] = 'Master/get_user_institution';
$route['api/master/update/user'] = 'Master/update_user_institution';
$route['api/master/delete/user/:num'] = 'Master/delete_user_institution';

// Category Master Endpoint
$route['api/master/add/category'] = 'Master/add_category';
$route['api/master/get/category/:num'] = 'Master/get_category';
$route['api/master/update/category'] = 'Master/update_category';

// Job Master Endpoint
$route['api/jobs'] = 'API/getJobsAPI';
$route['api/master/add/job'] = 'Master/add_job';
$route['api/master/get/job/:num'] = 'Master/get_job';
$route['api/master/update/job'] = 'Master/update_job';
$route['api/master/delete/job/:num'] = 'Master/delete_job';


$route['master/participant'] = 'Form_Register/participant';
$route['master/participant/delete/(:any)'] = 'Form_Register/delete/$1';

// $route['api/mahasiswa/delete/(:any)'] = 'MahasiswaController/deleteMahasiswa/$1';
