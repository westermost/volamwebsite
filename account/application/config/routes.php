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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Welcome';
$route['404_override'] = 'Errors';
$route['translate_uri_dashes'] = FALSE;

// Routes for app
$route['Login'] = 'Account/Login';
$route['Register'] = 'Account/Register';
$route['ForgotPass'] = 'Account/ForgotPass';
$route['Member'] = 'Member/Home';
$route['Game'] = 'Game/Home';
$route['Cash'] = 'Cash/Home';
$route['Game/GiftBox/(:num)'] = 'Game/GiftBox';
$route['Account/VerifyEmail/(:any)/(:any)'] = 'Account/VerifyEmail';
$route['Account/UnLockAccount/(:any)/(:any)'] = 'Account/UnLockAccount';
$route['Game/OnlineEvent/Receive/(:num)/(:num)']         = 'Game/OnlineEvent/Receive';

// Routes for admin page:
$route['admincp'] = 'Admin/Home';
$route['Admin/EditGiftItem/(:num)']         = 'Admin/EditGiftItem';
$route['Admin/DelGiftItem/(:num)']          = 'Admin/DelGiftItem';
$route['Admin/AddGiftPackDetail/(:num)']    = 'Admin/AddGiftPackDetail';
$route['Admin/AddGiftPackDetail/Approve/(:num)']    = 'Admin/AddGiftPackDetail/Approve';
$route['Admin/EditGiftPack/(:num)']         = 'Admin/EditGiftPack';
$route['Admin/DelGiftPack/(:num)']         = 'Admin/DelGiftPack';
$route['Admin/DownGiftCodes/(:num)']         = 'Admin/DownGiftCodes';
$route['Admin/EditGift/(:num)']         = 'Admin/EditGift';
$route['Admin/DelGift/(:num)']         = 'Admin/DelGift';
$route['Admin/OnlineGift/Edit/(:num)']         = 'Admin/OnlineGift/Edit';
