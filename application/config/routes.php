<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'home';

$route['dashboard'] = 'owner/dashboard';
$route['profil'] = 'owner/profil';
$route['info-apps'] = 'owner/info_app';

// users
$route['users'] = 'owner/user';
$route['users/create'] = 'owner/user/create';
$route['users/store'] = 'owner/user/store';
$route['users/check'] = 'owner/user/check_duplicate';
$route['users/update'] = 'owner/user/update';
$route['users/delete'] = 'owner/user/delete';
$route['users/edit/(:any)'] = 'owner/user/edit/$1';

// kategori
$route['kategori'] = 'owner/kategori';
$route['kategori/store'] = 'owner/kategori/store';

// units
$route['units'] = 'owner/units';
$route['units/store'] = 'owner/units/store';

// items
$route['items'] = 'owner/items';
$route['items/create'] = 'owner/items/create';
$route['items/store'] = 'owner/items/store';

// supplier
$route['supplier'] = 'owner/supplier';
$route['supplier/store'] = 'owner/supplier/store';

// barang-masuk
$route['barang-masuk'] = 'owner/barang_masuk';
$route['barang-masuk/create'] = 'owner/barang_masuk/create';
$route['barang-masuk/store'] = 'owner/barang_masuk/store';

// barang-keluar
$route['barang-keluar'] = 'owner/barang_keluar';

$route['apps-kasir'] = 'staf/app_kasir';
$route['apps-kasir/process'] = 'staf/app_kasir/process';
$route['apps-kasir/cart-data'] = 'staf/app_kasir/cart_data';
$route['apps-kasir/cart-del'] = 'staf/app_kasir/cart_del';
$route['apps-kasir/reset'] = 'staf/app_kasir/reset';
$route['apps-kasir/update'] = 'staf/app_kasir/update';
$route['apps-kasir/edit'] = 'staf/app_kasir/edit';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
