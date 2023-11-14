<?php
require_once 'libs/router.php';
require_once 'config.php';
require_once 'app/controllers/products.api.controller.php';
require_once 'app/controllers/categories.api.controller.php';
require_once 'app/controllers/comments.api.controller.php';
require_once 'app/controllers/login.api.controller.php';

$r = new Router();

//PRODUCTOS
$r->addRoute('products', 'GET', 'ProductsController', 'GetProducts');
$r->addRoute('products/:ID', 'GET', 'ProductsController', 'GetProducts');
$r->addRoute('products', 'POST', 'ProductsController', 'InsertProduct');
$r->addRoute('products/:ID', 'PUT', 'ProductsController', 'UpdateProduct');
$r->addRoute('products/:ID', 'DELETE', 'ProductsController', 'DeleteProduct'); 
//CATEGORIAS
$r->addRoute('categories', 'GET', 'CategoriesController', 'GetCategories');
$r->addRoute('categories/:ID', 'GET', 'CategoriesController', 'GetCategories');
$r->addRoute('categories', 'POST', 'CategoriesController', 'InsertCategory');
$r->addRoute('categories/:ID', 'PUT', 'CategoriesController', 'UpdateCategory');
$r->addRoute('categories/:ID', 'DELETE', 'CategoriesController', 'DeleteCategory');
//COMENTARIOS
$r->addRoute('comments', 'GET', 'CommentsController', 'GetComments');
$r->addRoute('comments/:ID', 'GET', 'CommentsController', 'GetComments');
// $r->addRoute('comments/:ORDER/:SORT', 'GET', 'CommentsController', 'GetCommentsOS');
$r->addRoute('comments', 'POST', 'CommentsController', 'InsertComment');
$r->addRoute('comments/:ID', 'PUT', 'CommentsController', 'UpdateComment');
$r->addRoute('comments/:ID', 'DELETE', 'CommentsController', 'DeleteComment');

//TOKEN
$r->addRoute('auth/token', 'GET', 'LoginApiController', 'getToken'); 

$r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);


