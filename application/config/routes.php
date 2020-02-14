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
$route['default_controller'] = 'front/page/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/**
 * Admin Routes
 */

// User Routes
$route['admin'] = 'admin/user';
$route['admin/dashboard'] = 'admin/user/dashboard';
$route['admin/logout'] = 'admin/user/logout';
$route['admin/forgot-password'] = 'admin/user/forgot_password';
$route['admin/reset-password'] = 'admin/user/reset_password';
$route['admin/profile'] = 'admin/user/profile';

/**
 * Turf Manager Routes
 */

// User Routes
$route['manager'] = 'manager/user';
$route['manager/register'] = 'manager/user/register';
$route['manager/otp'] = 'manager/user/otp';
$route['manager/password'] = 'manager/user/password';
$route['manager/dashboard'] = 'manager/user/dashboard';
$route['manager/logout'] = 'manager/user/logout';
$route['manager/forgot-password'] = 'manager/user/forgot_password';
$route['manager/reset-password'] = 'manager/user/reset_password';
$route['manager/profile'] = 'manager/user/profile';

// Booking Routes
$route['manager/bookings'] = 'manager/booking/index';
$route['manager/booking/cancel/(:num)'] = 'manager/booking/cancel/$1';

/**
 * Player Routes
 */

// User Routes
$route['player'] = 'player/user';
$route['player/register'] = 'player/user/register';
$route['player/otp'] = 'player/user/otp';
$route['player/password'] = 'player/user/password';
$route['player/logout'] = 'player/user/logout';
$route['player/forgot-password'] = 'player/user/forgot_password';
$route['player/reset-password'] = 'player/user/reset_password';
$route['player/profile'] = 'player/user/profile';

// Booking Routes
$route['bookings'] = 'player/booking/index';
$route['booking/cancel/(:num)'] = 'player/booking/cancel/$1';
$route['booking/view/(:any)'] = 'player/booking/view/$1';
$route['booking/invite/(:any)'] = 'player/booking/invite/$1';
$route['booking/invite-resend/(:num)'] = 'player/booking/invite_resend/$1';
$route['booking/invite-remove/(:num)'] = 'player/booking/invite_remove/$1';
$route['booking/invite-add/(:num)/(:num)'] = 'player/booking/invite_add/$1/$2';
$route['booking/success'] = 'player/booking/success';

/**
 * Front Routes
 */

// Page Routes
$route['about-us'] = 'front/page/about_us';
$route['contact-us'] = 'front/page/contact_us';
$route['podcast'] = 'front/page/podcast';
$route['blogs'] = 'front/page/blogs';
$route['blog/(:any)'] = 'front/page/blog/$1';
$route['find-a-turf/(:any)'] = 'front/page/find_a_turf/$1';




