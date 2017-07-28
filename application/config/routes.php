<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
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
$route['([a-zA-Z_-]+)'] = 'index/$1';

$route['login'] = "admin/admin/login";

//$route['default_controller'] = "admin/admin/index";
$route['admin/purchase_history'] = 'admin/admin/purchase_history';

$route['logout'] = "users/admin/logout";
 $route['default_controller'] = "index";
 
$route['404_override'] = 'admin/admin/gotcha';
$route['admin/(login|logout|profile|license|change_password|forgot_password|backup|activity|do_key)'] = 'admin/admin/$1';
$route['admin/(profile|change_password|forgot_password)/(:any)'] = 'admin/admin/$1/$2';
 $route['settings/([a-zA-Z_-]+)'] = 'settings/$1';

$route['admin/companies/list/(:any)'] = "companies/admin/index/$1";
$route['admin/companies/All'] = "companies/admin/index";
$route['admin/([a-zA-Z_-]+)'] = '$1/admin';
$route['admin/(search)/(:any)'] = 'admin/admin/search/$1';
$route['admin/([a-zA-Z_-]+)/(:any)'] = '$1/admin/$2';

$route['contact'] = "index/contact";
$route['announcements'] = "index/announcements";
$route['events'] = "index/events";
$route['meetings'] = "index/meetings";
$route['sermons'] = "index/sermons";
$route['video_sermons'] = "index/video_sermons";
$route['mobile_register'] = "index/mobile_register";
$route['prayer_request'] = "index/prayer_request";
$route['hbcs'] = "index/hbcs";
$route['ministries'] = "index/ministries";

$route['admin/reset_password/(:any)'] = "users/admin/reset_password/$1";

$route['admin'] = "admin/admin/index";

