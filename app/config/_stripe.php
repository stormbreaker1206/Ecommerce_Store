<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 21/11/2018
 * Time: 5:56 PM
 */
use Stripe\Stripe;
use App\classes\Session;

$stripe = array(

    //api keys
    'secret_key' => getenv('STRIPE_SECRET'),
    'publishable_key' => getenv('STRIPE_PUBLISHER_KEY')

);

Session::add('publishable_key', $stripe['publishable_key']);
Stripe::setApiKey($stripe['secret_key']);