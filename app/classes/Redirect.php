<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 01/11/2018
 * Time: 4:16 PM
 */

namespace App\classes;


class Redirect
{
    //redirects to specific page
    public static function to($page){

        header("location: $page");
}

    //redirect to same page

    public static function back(){
        $uri =$_SERVER['REQUEST_URI'];
        header("location: $uri");
    }


}