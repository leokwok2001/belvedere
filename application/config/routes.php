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
|       [url name]                  [real controllor]
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/



$route['genmanfee_batch_rpt/create'] = 'genmanfee_batch_rpt/create';
$route['Carparkowner/view']='Carparkowner/view';

$route['carpark/view']='carpark/view';
$route['propertyowner/view']='propertyowner/view';

$route['owner/view']='owner/view';
$route['payment_barcode/create']='payment_barcode/create';


//$route['carpark/create/(:any)']='carowns/create/$1';
//$route['carowns/edit/(:any)/(:any)']='carowns/edit/$1/$2';

$route['maintance_resident/view'] ='maintance_resident/view';
$route['carpayment/view'] ='carpayment/view';

$route['gencarmfee/view']='gencarmfee/view';
$route['carmfee/view'] = 'carmfee/view';
$route['paymentreceipt/create_pdf/(:any)'] ='paymentreceipt/create_pdf/$1';
$route['outstanding_rpt/create_pdf'] ='outstanding_rpt/create_pdf';
$route['payment/create_copy/(:any)'] = 'payment/create_copy/$1';
$route['readexcel/create'] = 'readexcel/create';

$route['payment/view'] ='payment/view';
$route['payment/edit/(:any)'] = 'payment/edit/$1';

$route['genmfree/edit/(:any)'] = 'genmfree/edit/$1';
$route['genmfree/view/(:any)'] ='genmfree/view/$1';
$route['payment/update_status/(:any)/(:any)'] ='payment/update_status/$1/$2';

$route['mfree/view'] ='mfree/view';
$route['mfree/create'] ='mfree/create';  
$route['mfree/edit/(:any)'] = 'mfree/edit/$1';


$route['resident/view'] ='resident/view';
$route['resident/create'] ='resident/create';
$route['resident/edit/(:any)'] = 'resident/edit/$1';


$route['resident_rpt/create_pdf'] ='resident_rpt/create_pdf';

$route['genmfree_batch_rpt/create_pdf'] ='genmfree_batch_rpt/create_pdf';
$route['genmfree_batch_rpt/create_pdf/(:any)'] ='genmfree_batch_rpt/create_pdf/$1';

$route['default_controller'] = 'resident/view';
//$route['default_controller'] = "welcome";
$route['404_override'] = '';

//$route['translate_uri_dashes'] = FALSE;
/* End of file routes.php */
/* Location: ./application/config/routes.php */
