<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 27/10/2018
 * Time: 12:25 AM
 */

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Models\Product;



use App\Classes\Mail;

class IndexController extends BaseController
{
    public function show(){
        //generate a token for the user
        $token = CSRFToken::_token();
        //return the token in the view
        return view('home', compact('token'));


    }

    public function featuredProducts()
    {
        //query the product table and retrieve featured products in a random order
        $products = Product::where('featured', 1)->inRandomOrder()->limit(4)->get();
        echo json_encode(['featured' => $products]);
    }

    public function getProducts(){

        //query the product table and retrieve products starting from 0 up to 8
        $products = Product::where('featured', 0)->skip(0)->take(8)->get();
        echo json_encode(['products' => $products, 'count' => count($products)]);

    }
    public function loadMoreProducts()
    {
        $request = Request::get('post');
        if(CSRFToken::verifyCSRFToken($request->token, false)){
            $count = $request->count;
            $item_per_page = $count + $request->next;
            $products = Product::where('featured', 0)->skip(0)->take($item_per_page)->get();
            echo json_encode(['products' => $products, 'count' => count($products)]);
        }
    }


}