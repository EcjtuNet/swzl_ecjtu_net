<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "info";
$route['404_override'] = '';

$route['ajax/(:any)/(:any)/(:any)'] = 'info/ajax/$1/$2/$3';
$route['ajax/detail/(:any)/(:num)'] = 'detail/$1/$2';
$route['ajax/phone/(:num)'] = 'detail/ajaxphone/$1';


$route['info'] = 'info/infofunc';
$route['info/(:any)'] = 'info/infofunc/$1';
$route['info/(:any)/(:num)'] = 'info/infofunc/$1/$2';

$route['a/info'] = 'info/ajaxinfofunc';
$route['a/info/(:any)'] = 'info/ajaxinfofunc/$1';
$route['a/info/(:any)/(:num)'] = 'info/ajaxinfofunc/$1/$2';
$route['post'] = 'post/postfunc';
$route['search'] = 'search/searchfunc';
$route['search/(:any)/(:any)/(:num)'] = 'search/searchlist/$1/$3/$2';
$route['detail/(:any)/(:num)'] = 'detail/detailfunc/$1/$2';
$route['a/detail/(:num)'] = 'detail/phone/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
