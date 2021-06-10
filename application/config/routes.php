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
// $route['home2'] = "home_about_controller/homecarrousel"; 

// Routes del login, registre, logout, update, changepass i profile
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
$route['recurs/formrecursos'] = 'recursos_controller/formrecursos';
$route['recurs/infografia'] = 'recursos_controller/recurs_infografia';
$route['recurs/pissarra'] = 'recursos_controller/recurs_pissarra';
$route['recurs/video'] = 'recursos_controller/recurs_video';
$route['recurs/link_video'] = 'recursos_controller/recurs_link';
//Routes per veure els recursos
$route['recursos/(:num)'] = "recursos_controller/recursos_categoria/$1";
$route['recursos/mostrar_infografia/(:num)'] = "recursos_controller/mostrar_infografia/$1";
$route['recursos/mostrar_video/(:num)'] = "recursos_controller/mostrar_video/$1";
$route['recursos/mostrar_link_video/(:num)'] = "recursos_controller/mostrar_link_video/$1";
$route['recursos/mostrar_pissarra/(:num)'] = "recursos_controller/mostrar_pissarra/$1";
//Routes la descarrega dels arxius prncipals i adjunts
$route['recurs/(:num)'] = "recursos_controller/veure_arxiu_principal/$1";
$route['recurs/arxius/(:num)/adjunts/(:num)'] = "recursos_controller/veure_arxius_adjunts/$1/$2";
//Routes per mostrar els recursos (si no estas logged)
$route['recursos/public/(:num)'] = "public_recursos_controller/precursos_categoria/$1";
$route['recursos/public/mostrar_infografia/(:num)'] = "public_recursos_controller/pmostrar_infografia/$1";
$route['recursos/public/mostrar_video/(:num)'] = "public_recursos_controller/pmostrar_video/$1";
$route['recursos/public/mostrar_link_video/(:num)'] = "public_recursos_controller/pmostrar_link_video/$1";
$route['recursos/public/mostrar_pissarra/(:num)'] = "public_recursos_controller/pmostrar_pissarra/$1";
//Routes la descarrega dels arxius prncipals i adjunts (si no estas logged)
$route['recurs/public/(:num)'] = "public_recursos_controller/pveure_arxiu_principal/$1";
$route['recurs/public/arxius/(:num)/adjunts/(:num)'] = "public_recursos_controller/pveure_arxius_adjunts/$1/$2";


$route['recursos/list_recursos_modificar'] = 'recursos_controller/llistar_recursos_usuari';
$route['recursos/list_recursos'] = 'recursos_controller/llistar_recursos';

//Modificar Infografia i arxius
$route['recursos/modificar_infografia'] = 'recursos_controller/modificar_infografia';
$route['recursos/modificar_infografia/(:any)'] = 'recursos_controller/modificar_infografia_form/$1';
$route['recurs/infografia/borrar/(:num)'] = "recursos_controller/borrar_arxiu_principal_infografia/$1";
$route['recurs/infografia/borrar/arxius/(:num)/adjunts/(:num)'] = "recursos_controller/borrar_arxius_adjunts_infografia/$1/$2";
//Modificar video i arxius
$route['recursos/modificar_video'] = 'recursos_controller/modificar_video';
$route['recursos/modificar_video/(:any)'] = 'recursos_controller/modificar_video_form/$1';
$route['recurs/video/borrar/(:num)'] = "recursos_controller/borrar_arxiu_principal_video/$1";
$route['recurs/video/borrar/arxius/(:num)/adjunts/(:num)'] = "recursos_controller/borrar_arxius_adjunts_video/$1/$2";
//Modificar link_video i arxius
$route['recursos/modificar_link_video'] = 'recursos_controller/modificar_link_video';
$route['recursos/modificar_link_video/(:any)'] = 'recursos_controller/modificar_link_video_form/$1';
$route['recurs/link/borrar/arxius/(:num)/adjunts/(:num)'] = "recursos_controller/borrar_arxius_adjunts_link/$1/$2";
//Modificar pissarra i arxius
$route['recursos/modificar_pissarra'] = 'recursos_controller/modificar_pissarra';
$route['recursos/modificar_pissarra/(:any)'] = 'recursos_controller/modificar_pissarra_form/$1';
$route['recurs/pissarra/borrar/arxius/(:num)/adjunts/(:num)'] = "recursos_controller/borrar_arxius_adjunts_pissarra/$1/$2";


$route['recurs/(:num)'] = "recursos_controller/veure_arxiu_principal/$1";
$route['recurs/arxius/(:num)/adjunts/(:num)'] = "recursos_controller/veure_arxius_adjunts/$1/$2";

$route['recurs/recursosgrocery'] = 'recursos_controller/recursosgrocery';
$route['recurs/recursosgrocery/(:any)'] = 'recursos_controller/recursosgrocery/$1';
$route['recurs/recursosgrocery/(:any)/(:any)'] = 'recursos_controller/recursosgrocery/$1/$2';

$route['recursos/recursosgrocery'] = 'grocery_controller/recursosgrocery';
$route['recursos/recursosgrocery/(:any)'] = 'grocery_controller/recursosgrocery/$1';
$route['recursos/recursosgrocery/(:any)/(:any)'] = 'grocery_controller/recursosgrocery/$1/$2';

$route['tags/tagsgrocery'] = 'grocery_controller/tagsgrocery';
$route['tags/tagsgrocery/(:any)'] = 'grocery_controller/tagsgrocery/$1';
$route['tags/tagsgrocery/(:any)/(:any)'] = 'grocery_controller/tagsgrocery/$1/$2';


//API
$route['api_private/recursos/login'] = 'jwtapi_controller/login';
$route['api_private/recursos'] = 'jwtapi_controller/recursos';
$route['api_private/recurs/(:any)'] = 'jwtapi_controller/recurs/$1';

$route['api_private/arxiu/recurs'] = 'jwtapi_controller/arxiup';
$route['api_private/adjunts/recurs'] = 'jwtapi_controller/arxiuadj';

$route['api_private/user'] = 'jwtapi_controller/infouser';



$route['api_private/imatge/(:any)'] = 'Downtoken_controller/imatgeprincipal/$1';
$route['api_private/arxius/(:any)/adjunts/(:any)'] = 'Downtoken_controller/arxiusadjunts/$1/$2';