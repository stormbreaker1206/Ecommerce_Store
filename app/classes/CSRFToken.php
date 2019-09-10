<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 01/11/2018
 * Time: 10:57 AM
 */




namespace App\Classes;


class CSRFToken
{
    /**
     * Generate Token
     * @return mixed
     */
    public static function _token()
    {
        if(!Session::has('token')){
            $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
            Session::add('token', $randomToken);
        }
        return Session::get('token');
    }

    /**
     * Verify CSRF TOKEN
     * @param $requestToken
     * @return bool
     */
    public static function verifyCSRFToken($requestToken, $regenerate = true)
    {
        if(Session::has('token') && Session::get('token') === $requestToken){

            if($regenerate){
                Session::remove('token');

            }

            return true;
        }
        return false;
    }
}