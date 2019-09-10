<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 27/10/2018
 * Time: 12:10 AM
 */

//route map for admin page
$router->map('GET','/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard');
$router->map('GET', '/admin/charts', 'App\Controllers\Admin\DashboardController@getChartData',
    'admin_dashboard_charts');


//product management route
$router->map('GET','/admin/products/categories','App\Controllers\Admin\ProductCategoryController@show','product_category');
$router->map('POST','/admin/products/categories','App\Controllers\Admin\ProductCategoryController@store','create_product_category');

//edit products category
$router->map('POST','/admin/products/categories/[i:id]/edit','App\Controllers\Admin\ProductCategoryController@edit','edit_product_category');

//delete products category
$router->map('POST','/admin/products/categories/[i:id]/delete','App\Controllers\Admin\ProductCategoryController@delete','delete_product_category');

// add sub category
$router->map('POST','/admin/products/subcategory/create','App\Controllers\Admin\SubCategoryController@store','create_sub_category');

//edit sub category
$router->map('POST','/admin/products/subcategory/[i:id]/edit','App\Controllers\Admin\SubCategoryController@edit','edit_subcategory');

//delete sub category
$router->map('POST','/admin/products/subcategory/[i:id]/delete','App\Controllers\Admin\SubCategoryController@delete','delete_subcategory');

// show product form
$router->map('GET','/admin/products/create','App\Controllers\Admin\ProductController@showCreateProductForm','create_products_form');
//create a product
$router->map('POST','/admin/products/create','App\Controllers\Admin\ProductController@store','create_products');
//on change events
$router->map('GET','/admin/category/[i:id]/selected','App\Controllers\Admin\ProductController@getSubcategories','selected_category');

//Admin products
$router->map('GET','/admin/products','App\Controllers\Admin\ProductController@show','show_products');

// Edit Product
$router->map('GET','/admin/products/[i:id]/edit','App\Controllers\Admin\ProductController@showEditProductForm','edit_products_form');
$router->map('POST','/admin/products/edit','App\Controllers\Admin\ProductController@edit','edit_products');

//delete product
$router->map('POST','/admin/products/[i:id]/delete','App\Controllers\Admin\ProductController@delete','delete_products');