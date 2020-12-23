<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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

$route['default_controller'] = "home";
$route['404_override'] = '';


$route['admin/home-features'] = 'admin/features/index/0';
$route['admin/home-features/add'] = 'admin/features/add/0';
$route['admin/home-features/edit/(:any)'] = 'admin/features/edit/$1/0';
$route['admin/home-features/delete/(:any)'] = 'admin/features/delete/$1/0';


$route['admin/login'] = 'admin/home/login';
$route['admin/logout'] = 'admin/home/logout';
$route['admin/dashboard'] = 'admin/home/dashboard';


$route['admin/upload_image'] = 'admin/content/upload_image';







$route['marketing/category/(:any)'] = 'landing/category/$1';
$route['about-us'] = "home/content/about-us";
$route['terms-and-conditions'] = "home/content/terms-and-conditions";

require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();

$query1 = $db->get_where('tbl_contents', array('status' => '1'));
$result1 = $query1->result();
foreach ($result1 as $row) {
    $route[$row->page_seo] = 'home/content/' . $row->page_seo;
}

//$route['dormer-loft-conversion'] = "home/content/dormer-loft-conversion";
//$route['hip-to-gable-loft-conversions'] = "home/content/hip-to-gable-loft-conversions";
//$route['mansard-loft-conversion'] = "home/content/mansard-loft-conversion";
//$route['velux-loft-conversion'] = "home/content/velux-loft-conversion";
//$route['l-shaped-dormer-loft-conversion'] = "home/content/l-shaped-dormer-loft-conversion";



$route['contact-us'] = "home/contact";
$route['faqs'] = "home/faqs";
$route['marketing'] = 'landing/blog';
$route['marketing/(:num)'] = "landing/blog";
$route['marketing/(:any)'] = 'landing/blog/$1';







