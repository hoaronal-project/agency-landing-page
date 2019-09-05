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
$route['default_controller'] 	= "home";
$route['404_override'] 			= 'my404';
//Frontend
$route['search-resume/html']= 'resume_search/index/$1';
$route['(:any).html'] 		= 'content/index/$1';
$route['login'] 			= 'job/login/$1';
$route['logout'] 			= 'job/logout/$1';
//$route['forgot'] 			= 'user/forgot/$1';
$route['contact-us'] 		= 'contact_us';
$route['register'] 			= 'job/register/$1';
$route['registration'] 		= 'job/registration/$1';
$route['job/apply_for_job/(:any)'] 	= 'job/apply_for_job/$1';
$route['job/job_info/(:any)'] 	= 'job/job_info/$1';
$route['job/apply/(:any)'] 	= 'job/apply/$1';
$route['job/(:any)'] 		= 'job/index/$1';
$route['industry/(:any)'] 	= 'industry/index/$1';
$route['news'] 		= 'news/all_news/$1';
$route['news/(:any)'] 		= 'news/index/$1';
$route['apply_job/(:num)'] 		= 'apply_job/index/$1';
//Backend
$route['admin/employers/(:num)'] 	= 'admin/employers/index/$1';
$route['admin/posted_jobs/(:num)'] = 'admin/posted_jobs/index/$1';
$route['admin/consultants/(:num)'] = 'admin/job_seekers/index/$1';
$route['admin/consultants'] 		= 'admin/job_seekers';
$route['admin/invite-consultant'] 	= 'admin/invite_jobseeker';
$route['admin/countries/(:num)'] 	= 'admin/countries/index/$1';
$route['admin/application_received/(:num)'] 	= 'admin/application_received/index/$1';
$route['admin/applied_jobs/(:num)'] 	= 'admin/applied_jobs/index/$1';
/*
/* End of file routes.php */
/* Location: ./application/config/routes.php */