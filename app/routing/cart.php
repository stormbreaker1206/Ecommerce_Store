<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 19/11/2018
 * Time: 3:38 PM
 */
//add to cart
$router->map('POST', '/cart', 'App\Controllers\CartController@addItem', 'add_cart_item');


//display cart
$router->map('GET', '/cart', 'App\Controllers\CartController@show', 'view_cart');

//display product in cart
$router->map('GET', '/cart/items', 'App\Controllers\CartController@getCartItems', 'view_cart_items');

//update cart
$router->map('POST', '/cart/update-qty', 'App\Controllers\CartController@updateQuantity', 'update_cart_qty');

//remove items from cart
$router->map('POST', '/cart/remove-item', 'App\Controllers\CartController@removeItem', 'remove_cart_item');


//empty entire cart
$router->map('POST', '/cart/empty-item', 'App\Controllers\CartController@emptyItem', 'empty_cart_item');

//stripe payments
$router->map('POST', '/cart/payment', 'App\Controllers\CartController@checkout', 'handle_payment');

//pay pal
$router->map('POST', '/paypal/create-payment',
    'App\Controllers\CartController@paypalCreatePayment', 'paypal_create_payment');
$router->map('POST', '/paypal/execute-payment',
    'App\Controllers\CartController@paypalExecutePayment', 'paypal_execute_payment');
