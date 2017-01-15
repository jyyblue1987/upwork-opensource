<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['app'] = 'app/index';
$route['app/(:any)'] = 'app/index/';
$route['materia'] = 'materia/index';
$route['materia/(:any)'] = 'materia/index';



$route['administrator'] = 'administrator/home';
$route['post-job'] = 'jobs/create';
$route['find-jobs'] = 'jobs/find';
$route['find-jobs/(:any)'] = 'jobs/find/($1)';
$route['jobs-home'] = 'jobs/status';
$route['payment-methods'] = 'payment/methods';
$route['payment-methods/remove'] = 'payment/removeAccount';
$route['payment-methods/add-account'] = 'payment/addPaymentMethodAcc';
$route['payment/tax-information'] = 'payment/taxInformation';
$route['payment/tax-information-save'] = 'payment/updateTaxInformation';
$route['profile-settings'] = 'profilesetting';
$route['administrator/(:any)'] = 'administrator/$1';
$route['profile/update-basic-profile'] = "profile/updateBasicProfile";
$route['profile/update-portfolio'] = "profile/updatePortfolio";
$route['profile/my-freelancer-profile'] = "profile/freelancerProfile";
$route['profile/update-contact-details'] = "profile/updateContactDetails";
$route['profile/remove-portfolio'] = "profile/removePortfolio";
$route['profile/edit-portfolio'] = "profile/editPortfolio";
$route['profile/find-freelancer'] = "profile/searchFreelancer";
$route['search'] = "search";
$route['homepage'] = "home/homepage";
$route['json/(:any)'] = 'json/(:any)';
$route['endjobs'] = 'Winsjob/endjobs';


$route['profile/manageaccount'] = "profile/manageaccount";
$route['profile/basic'] = "profile/basic";
$route['profile/basic_bio'] = "profile/basic_bio";
$route['profile/(:any)'] = 'profile/index/($1)';



