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

$route['login'] = 'Apps';
$route['login/validate'] = 'Apps/validate';

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
$route['barang-masuk/delete'] = 'owner/barang_masuk/delete_in';
$route['barang-masuk/deleted'] = 'owner/barang_masuk/delete_response';
$route['barang-masuk/filter'] = 'owner/barang_masuk/filter_data';
// filter
$route['filter/get'] = 'filter/filter_by_date_ajax';
$route['filter/get-out'] = 'filter/filter_by_date_ajax_out';
// $route['barang-masuk/filter'] = 'filter/filter_data';

// barang-keluar
$route['barang-keluar'] = 'owner/barang_keluar';
$route['barang-keluar/create'] = 'owner/barang_keluar/create';
$route['barang-keluar/store'] = 'owner/barang_keluar/store';
$route['barang-keluar/delete'] = 'owner/barang_keluar/delete_out';

$route['apps-kasir'] = 'staf/app_kasir';
$route['apps-kasir/process'] = 'staf/app_kasir/process';
$route['apps-kasir/cart-data'] = 'staf/app_kasir/cart_data';
$route['apps-kasir/cart-del'] = 'staf/app_kasir/cart_del';
$route['apps-kasir/reset'] = 'staf/app_kasir/reset';
$route['apps-kasir/update'] = 'staf/app_kasir/update';
$route['apps-kasir/edit'] = 'staf/app_kasir/edit';
$route['apps-kasir/print/(:num)'] = 'staf/app_kasir/print/$1';


$route['apps-kasir/get-all-barang'] = 'staf/app_kasir/get_all_barang';
$route['apps-kasir/keranjang-barang'] = 'staf/app_kasir/keranjang_barang';
$route['apps-kasir/store'] = 'staf/app_kasir/store';



// $route['kasir'] = 'staf/kasir/index';
// $route['kasir/add_to_cart'] = 'staf/kasir/add_to_cart';
// $route['kasir/remove_from_cart'] = 'staf/kasir/remove_from_cart';
// $route['kasir/process_payment'] = 'staf/kasir/process_payment';
// $route['kasir/get_items'] = 'staf/kasir/get_items';


// history-transaksi
$route['history-transaksi'] = 'staf/history_transaksi';
$route['history-transaksi/filter'] = 'staf/history_transaksi/filter_sales';


$route['riwayat-penjualan'] = 'owner/Riwayat_penjualan';
$route['riwayat-penjualan/export-pdf'] = 'owner/Riwayat_penjualan/export_pdf';
$route['riwayat-penjualan/export-excel'] = 'owner/Riwayat_penjualan/export_excel';

$route['stok-produk'] = 'owner/Stok_produk';
$route['stok-produk/filter'] = 'owner/Stok_produk/get_product_data';
$route['stok-produk/export-pdf'] = 'owner/Stok_produk/export_pdf';
$route['stok-produk/export-excel'] = 'owner/Stok_produk/export_excel';

$route['filter-laporan'] = 'owner/Filter_laporan';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
