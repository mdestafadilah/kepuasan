<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Digunakan untuk mengatur kemana rekuest method pergi
 * 
 * Oleh : Much. D. Fadilah
 * 
 * Terdiri dari 5 Role dengan 1 role default (members)
 * - Role admin sebagai Administrator Utama
 * - Role manajer sebagai Admin dari Perusahaan
 * - Role direktur sebagai Direktur dari perusahaan
 * - Role perawat sebagai pegawai perusahaan, atau perawat konsumen
 * - Role konsumen sebagai pelanggan perusahaan, atau majikan perawat
 * - Role member sebagai default - tidak akan digunakan!!
 */

	$route['user/admin'] = 'admin';
	$route['user/admin/(:any)'] = 'admin/$1';
	
	$route['user/manajer'] = 'manajer';
	$route['user/manajer/(:any)'] = 'manajer/$1';
		
	
	$route['user/direktur'] = 'direktur';
	$route['user/direktur/(:any)'] = 'direktur/$1';
	
	$route['user/konsumen'] = 'konsumen';
	$route['user/konsumen/(:any)'] = 'konsumen/$1';
	
	$route['user/perawat'] = 'perawat';
	$route['user/perawat/(:any)'] = 'perawat/$1';
	
	$route['user/members'] = 'member'; //default
	$route['user/(.*)'] = 'user/$1';
	
	$route['404_override'] = 'errors/error_404';

/* resources */
// $route['([a-zA-Z_-]+)'] = 'user/admin/$1';
// $route['^([a-z]{2})/(.*)'] = '$2';
// $route['^([a-z]{2})'] = $route['default_controller'];
// $route['(:any)/page/test'] = "$1/news/page/1";
// $route['(:any)/page/test'] = "news/page/1";
// http://stackoverflow.com/questions/9694419/how-can-i-solve-routing-in-hmvc

/* End of file routes.php */
/* Location: ./application/modules/user/config/routes.php */
