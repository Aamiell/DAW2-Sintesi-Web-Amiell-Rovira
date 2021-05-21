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
$route['default_controller'] = 'home_about_controller/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*URL |_pagina/(algo)_| |(:Expreg)(:any)(:num)| ==> controlador (pages) funcio (view) parametre ($1) */

$route['home'] = "home_about_controller/home"; 
$route['about'] = "home_about_controller/about"; 
$route['home2'] = "home_about_controller/homecarrousel"; 
// Routes del login
$route['login'] = "logins_controller/login";
$route['login/registre'] = "logins_controller/registre"; 
$route['login/logout'] = "users_controller/logout"; 
$route['login/settings'] = "users_controller/settings";
$route['login/settings_update'] = "users_controller/settings_update";
$route['login/changepass'] = "users_controller/changepass";
$route['login/changepass_update'] = "users_controller/changepass_update";
$route['login/profile'] = "users_controller/profile";

//Routa per mostrar les categories
$route['tree/category'] = 'treecat_controller/index'; 

// Routes per els grocerys del admin
$route['users/usersgrocery'] = 'grocery_controller/usersgrocery';
$route['users/usersgrocery/(:any)'] = 'grocery_controller/usersgrocery/$1';
$route['users/usersgrocery/(:any)/(:any)'] = 'grocery_controller/usersgrocery/$1/$2';

$route['users/users_groupgrocery'] = 'grocery_controller/users_groupgrocery';
$route['users/users_groupgrocery/(:any)'] = 'grocery_controller/users_groupgrocery/$1';
$route['users/users_groupgrocery/(:any)/(:any)'] = 'grocery_controller/users_groupgrocery/$1/$2';

// Routes per crear els recursos
$route['recurs/formrecurs'] = 'recursos_controller/formrecurs';

$route['recurs/formrecursos'] = 'recursos_controller/formrecursos';
$route['recurs/infografia'] = 'recursos_controller/recurs_infografia';
$route['recurs/pissarra'] = 'recursos_controller/recurs_pissarra';
$route['recurs/video'] = 'recursos_controller/recurs_video';
$route['recurs/link_video'] = 'recursos_controller/recurs_link_video';

$route['recurs/recursosgrocery'] = 'recursos_controller/recursosgrocery';
$route['recurs/recursosgrocery/(:any)'] = 'recursos_controller/recursosgrocery/$1';
$route['recurs/recursosgrocery/(:any)/(:any)'] = 'recursos_controller/recursosgrocery/$1/$2';

$route['recursos/recursosgrocery'] = 'grocery_controller/recursosgrocery';
$route['recursos/recursosgrocery/(:any)'] = 'grocery_controller/recursosgrocery/$1';
$route['recursos/recursosgrocery/(:any)/(:any)'] = 'grocery_controller/recursosgrocery/$1/$2';

$route['tags/tagsgrocery'] = 'grocery_controller/tagsgrocery';
$route['tags/tagsgrocery/(:any)'] = 'grocery_controller/tagsgrocery/$1';
$route['tags/tagsgrocery/(:any)/(:any)'] = 'grocery_controller/tagsgrocery/$1/$2';

$route['upload/do_upload'] = 'upload_controller/do_upload';
$route['upload'] = 'upload_controller/index';

