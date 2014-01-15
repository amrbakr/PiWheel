<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "home";

$route['home'] = 'home';
$route['login'] = 'home/login';
$route['register'] = 'home/register';
$route['student'] = 'home/student';
$route['instructor'] = 'home/instructor';
$route['logout'] = 'home/logout';
$route['activation/token/(:any)'] = 'home/activateUser';

$route['profile/(:any)'] = 'home/profile';
$route['course/(:any)'] = 'home/course';


$route['changeEmail'] = 'home/changeEmail';
$route['changePassword'] = 'home/changePassword';



$route['404_override'] = '';
