<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 22/11/2018
 * Time: 3:12 PM
 */

namespace App\classes;


class Role
{
    public static function middleware($role)
    {
        $message = '';
        switch ($role){
            case 'admin':
                $message = 'You are not authorized to view admin panel';
                break;
            case 'user':
                $message = 'You are not authorized to view this page';
                break;
        }

        if(isAuthenticated()){
            if(user()->role != $role){
                Session::add('error', $message);
                return false;
            }
        }else{
            Session::add('error', $message);
            return false;
        }

        return true;
    }

}