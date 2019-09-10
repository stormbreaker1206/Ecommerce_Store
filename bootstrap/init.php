<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 26/10/2018
 * Time: 10:44 PM
 */
/** if session is not set start session */
if(!isset($_SESSION)) session_start();

/** load environment variables */

require_once __DIR__.'/../app/config/_env.php';

/** instantiate database class */
new App\Classes\Database();

/** set custom error handler */
set_error_handler([new \App\Classes\ErrorHandler(), 'handleErrors'], E_ALL);


/** instantiate route dispatcher */
require_once __DIR__.'/../app/routing/route.php';
new \App\RouteDispatcher($router);






