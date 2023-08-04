<?php
namespace Config;
use App\Controllers\Home;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.


//*Uncomment for Auto Route
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Pages::index');
$routes->get('/login', 'Pages::Login');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');
$routes->get('/dashboard', 'Pages::dashboard',['filter' => 'auth']);

//* Users
$routes->get('/users/register','Register::index',['filter' => 'auth']);
$routes->post('/users/save','Register::save',['filter' => 'auth']);

// $routes->get('/users/register','Register::index');
// $routes->post('/users/save','Register::save');
// ['filter' => 'auth']
//* Attributes
$routes->post('/attributes/create', 'Attributes::create',['filter' => 'auth']); //*Create
$routes->get('/attributes', 'Attributes::index',['filter' => 'auth']); //*Read
$routes->post('/attributes/update','Attributes::update',['filter' => 'auth']); //*Update
$routes->delete('/delete/attributes/(:any)', 'Attributes::deleteAttribute/$1',['filter' => 'auth']); //*Delete

//* Attributes Details
$routes->post('/attributedetails/create','AttributeDetails::create',['filter' => 'auth']); //* Create
$routes->get('/attributedetails/(:num)', 'AttributeDetails::index/$1',['filter' => 'auth']); //* Read
$routes->post('/attributedetails/update','AttributeDetails::update',['filter' => 'auth']); //*Update
$routes->delete('/delete/attributedetails/(:any)', 'AttributeDetails::deleteAttribute/$1',['filter' => 'auth']); //*Delete

//* Product Category
$routes->post('/productcategory/create', 'ProductCategory::create',['filter' => 'auth']); //*Create
$routes->get('/productcategory', 'ProductCategory::index',['filter' => 'auth']); //*Read
$routes->post('/productcategory/update', 'ProductCategory::update',['filter' => 'auth']); //*Update
$routes->delete('/delete/productcategory/(:any)', 'ProductCategory::delete/$1',['filter' => 'auth']); //*Delete

//* Brands
$routes->post('/brands/create', 'Brands::create',['filter' => 'auth']); //*Create
$routes->get('/brands', 'Brands::index',['filter' => 'auth']); //*Read
$routes->post('/brands/update', 'Brands::update',['filter' => 'auth']); //*Update
$routes->delete('/delete/brands/(:any)', 'Brands::delete/$1',['filter' => 'auth']); //*Delete

//*Products
$routes->get('/products/createpage', 'Products::createPage',['filter' => 'auth']); //*Create
$routes->post('/products/create', 'Products::create',['filter' => 'auth']); //*Create
$routes->get('/products', 'Products::index',['filter' => 'auth']); //*Read
$routes->get('/products/editpage/(:num)', 'Products::editPage/$1',['filter' => 'auth']); //*Update
$routes->post('/products/update', 'Products::update/$1',['filter' => 'auth']); //*Update
$routes->delete('/delete/products/(:any)', 'Products::delete/$1',['filter' => 'auth']); //*Delete

//*Transactions
$routes->get('/transactions', 'Transactions::index',['filter' => 'auth']); //*Read
$routes->get('/todaytransactions', 'Transactions::todaytransaction',['filter' => 'auth']); //*Read
$routes->get('/todaytransactions/(:num)', 'Transactions::todaytransactiondetails/$1',['filter' => 'auth']); //*Read
$routes->post('/transactions/addToCart', 'Transactions::addToCart',['filter' => 'auth']); //*Add To Cart
$routes->post('transactions/checkout', 'Transactions::checkout'); //* proses checkout

//*Profile Views
$routes->get('/profile', 'Pages::profile',['filter' => 'auth']);


//*User
$routes->get('/users', 'Pages::user',['filter' => 'auth']);





// *! (:any) -> place holder (:segment), dll.
//*! Routes : segment1(controllers)/segment2(method)/segment3(params)
//* Example
//$routes->get('test3/(:any)','Home::coba/$1');
//---------------
/*



 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
?>