<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 01/11/2018
 * Time: 6:47 PM
 */

namespace App\classes;


class Request
{
    //return all request that we are interested in

    public static function all($is_array = false){
        $result = [];
        if(count($_GET) > 0) $result['get'] = $_GET;
        if(count($_POST) > 0) $result['post'] = $_POST;
        $result['file'] = $_FILES;
        return json_decode(json_encode($result), $is_array);


    }

    //get specific type of request
    public static  function get($key){
        $object = new static;
        $data = $object->all();
        return $data->$key;
    }

    //check request availability
    public static function has($key){
       return (array_key_exists($key, self::all(true))) ? true : false;
    }
    //get request data

    public static function old($key, $value){
        $object = new static;
        $data = $object->all();
        (isset($data->$key->$value)) ? $data->$key->$value : '';
    }

    //refresh request

    public static function refresh(){
        $_POST = [];
        $_GET = [];
        $_FILES = [];


    }

}