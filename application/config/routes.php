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

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['news/([0-9]+)-(.*)'] = 'post/show/$1';
$route['guides/([0-9]+)-(.*)'] = 'post/show/$1';
$route['video-guides/([0-9]+)-(.*)'] = 'post/show/$1';
$route['dev-updates/([0-9]+)-(.*)'] = 'post/show/$1';

$route['news'] = 'post/category/news/$1';
$route['news/page/(:num)'] = 'post/category/news';
$route['guides'] = 'post/category/guides';
$route['guides/page/(:num)'] = 'post/category/guides';
$route['video-guides'] = 'post/category/video-guides';
$route['video-guides/page/(:num)'] = 'post/category/video-guides';
$route['dev-updates'] = 'post/category/dev-updates';
$route['dev-updates/page/(:num)'] = 'post/category/dev-updates';

$route['profile/(:any)'] = 'user/profile/$1';

$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['register'] = 'user/register';
$route['reset-password'] = 'user/recover_password';
$route['reset-password/verify/(:any)'] = 'user/recover_password_verify';

$route['post/delete-comment/(:any)'] = 'post/delete_comment';

$route['profile'] = 'user/profile';
$route['profile/edit'] = 'user/edit_profile';
$route['profile/avatar'] = 'user/edit_avatar';
$route['profile/avatar/save'] = 'user/save_avatar';
$route['profile/password'] = 'user/edit_password';

$route['about-us'] = 'home/about';
$route['privacy-policy'] = 'home/privacy';
$route['contact-us'] = 'home/contact';
$route['sitemap.xml'] = 'sitemap';

/* FORUM ROUTING (complicated crap) */

$route['^forum/([A-Za-z0-9-]+)([\/]?)$'] = 'forum/viewforum/$1';
$route['^forum/thread/([0-9]+)-([A-Za-z0-9-]+)(\/?)$'] = 'forum/viewthread/$1';
$route['forum/([A-Za-z0-9-]+)/new-thread'] = 'forum/newthread';
$route['forum\/thread\/([0-9]+)-([A-Za-z0-9-]+)/reply'] = 'forum/reply';

/* ADMIN ROUTING */

// a.posts
$route['admin/posts'] = 'post/admin';
$route['admin/post/create'] = 'post/create';
$route['admin/post/edit/(:any)'] = 'post/edit/$1';
$route['admin/post/edit'] = 'post/edit';
$route['admin/post/delete/(:any)'] = 'post/delete/$1';

//a.users
$route['admin/users'] = 'user/admin';

/* End of file routes.php */