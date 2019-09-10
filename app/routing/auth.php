<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 20/11/2018
 * Time: 7:23 PM
 */

//register form
$router->map('GET','/register','App\Controllers\AuthController@showRegisterForm','register');

//register a user
$router->map('POST','/register','App\Controllers\AuthController@register','register_me');


//show login form
$router->map('GET','/login','App\Controllers\AuthController@showLoginForm','login');

//login a user
$router->map('POST','/login','App\Controllers\AuthController@login','Log_me_in');


//logout a user
$router->map('GET', '/logout', 'App\Controllers\AuthController@logout', 'logout');