<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 27/10/2018
 * Time: 12:10 AM
 */
$router = new AltoRouter;
//route map for index page
$router->map('GET','/','App\Controllers\IndexController@show','home');

//featured products routes
$router->map('GET', '/featured', 'App\Controllers\IndexController@featuredProducts', 'feature_product');

//featured products routes
$router->map('GET', '/get-products', 'App\Controllers\IndexController@getProducts', 'get_product');

//load more products on scroll
$router->map('POST', '/load-more', 'App\Controllers\IndexController@loadMoreProducts', 'load_more_product');

//product details
$router->map('GET','/product/[i:id]','App\Controllers\ProductController@show','product');

//product details info
$router->map('GET','/product-details/[i:id]','App\Controllers\ProductController@get','product_details');


require_once  __DIR__ . '/cart.php';

require_once __DIR__ . '/auth.php';

require_once __DIR__ . '/admin_routes.php';