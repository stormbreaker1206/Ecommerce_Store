<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 19/11/2018
 * Time: 10:11 AM
 */

namespace App\classes;


class Cart
{
    protected static $isItemInCart = false;

    public static function add($request)
    {
        try{
            $index = 0;
            //check to confirm if the item is already in cart
            if(!Session::has('user_cart') || count(Session::get('user_cart')) < 1){
                //if the session does not have cart and the count is less than 0 add item to cart the cart is empty add to cart
                Session::add('user_cart', [
                    0 => ['product_id' => $request->product_id, 'quantity' => 1]
                ]);
            }else{
                //check each item in the request to determine if it is already in the cart
                foreach ($_SESSION['user_cart'] as $cart_items){
                    $index++;
                    foreach ($cart_items as $key => $value){
                        if($key == 'product_id' && $value == $request->product_id){
                            array_splice($_SESSION['user_cart'], $index-1, 1,
                                array(
                                    [
                                        'product_id' => $request->product_id,
                                        'quantity' => $cart_items['quantity'] + 1
                                    ]
                                ));
                            self::$isItemInCart = true;
                        }
                    }
                }

                if(!self::$isItemInCart){
                    //add new item to cart if cart is empty
                    array_push($_SESSION['user_cart'], [
                        'product_id' => $request->product_id, 'quantity' => 1
                    ]);
                }
            }
        }catch (\Exception $ex){
            echo $ex->getMessage();
        }
    }

    public static function removeItem($index)
    {
        if(count(Session::get('user_cart')) <= 1){
            //empty cart
            self::clear();
        }else{
            //unset the specific item
            unset($_SESSION['user_cart'][$index]);
            sort($_SESSION['user_cart']);
        }
    }

    public static function clear()
    {
        Session::remove('user_cart');
    }



}