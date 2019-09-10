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

class ProductController extends BaseController
{
    public function show($id){
        //generate a token for the user
        $token = CSRFToken::_token();

        //query the database for the product with the product id that is sent via the url
        $product = Product::where('id', $id)->first();
        //return the token in the view
        return view('product', compact('token','product'));


    }

        public function get($id){
        $product = Product::where('id', $id)->with(['category', 'subCategory'])->first();

        if($product){

            $similar_products = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->inRandomOrder()->limit(4)->get();
           echo json_encode([

                'product' => $product,
                'category' => $product->category,
                'subCategory' => $product->subCategory,
                'similarProducts' => $similar_products


            ]);
           exit;
        }

        header('HTTP/1.1 422 Unprocessable Entity', true, 422);
        echo 'Product not Found';
        exit;

    }

}