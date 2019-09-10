<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 01/11/2018
 * Time: 11:38 PM
 */

namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Role;
use App\classes\Session;
use App\classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends BaseController
{

    public function __construct()
    {
        if(!Role::middleware('admin')){
            Redirect::to('/login');

        }
    }

    public function store(){

        if(Request::has('post')){

            $request = Request::get('post');
            $extra_errors = [];


            if(CSRFToken::verifyCSRFToken($request->token, false)){
               //process form data
                $rules = [
                    'name' => ['required' => true, 'minlength' => 3, 'string' => true],
                    'category_id' => ['required' => true]
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                //query the database for duplication

                $duplicate_subcategory = SubCategory::where('name', $request->name)->
                where('category_id', $request->category_id)->exists();

                if($duplicate_subcategory){
                    $extra_errors['name'] = array('Subcategory already exist.');
                }

                //check if product category id exist

                $category = Category::where('id', $request->category_id)->exists();

                if(!$category){
                    $extra_errors ['name'] = array('invalid Product Category.');
                }

                if($validate->hasError() || $duplicate_subcategory || !$category){


                    $error = $validate->getErrorMessages();
                    count($extra_errors) ? $response = array_merge($error, $extra_errors) : $response = $error;
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($response);
                    exit;
                }


                SubCategory::create([

                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    //remove all characters using the helper.php function
                    'slug' => slug($request->name)
                ]);

                echo json_encode(['success' => 'Subcategory created successfully']);
                exit;

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }

    /**
     * edit method
     */

    public function edit($id)
    {

        if(Request::has('post')){


          $request = Request::get('post');


            $extra_errors = [];

            if(CSRFToken::verifyCSRFToken($request->token, false)){
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3, 'mixed' => true],
                    'category_id' => ['required' => true]
                ];

                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                $duplicate_subcategory = SubCategory::where('name', $request->name)
                    ->where('category_id', $request->category_id)->exists();

                if($duplicate_subcategory){
                    $extra_errors['name'] = array('You have not made any changes.');
                }

                $category = Category::where('id', $request->category_id)->exists();
                if(!$category){
                    $extra_errors['name'] = array('Invalid product category.');
                }

                if($validate->hasError() || $duplicate_subcategory || !$category){
                    $error = $validate->getErrorMessages();
                    count($extra_errors) ? $response = array_merge($error, $extra_errors) : $response = $error;
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($response);
                    exit;
                }

                SubCategory::where('id', $id)->update(['name' => $request->name,
                    'category_id' => $request->category_id,
                    'slug' => slug($request->name) ]);
                echo json_encode(['success' => 'Subcategory Updated Successfully']);
                exit;
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }



    public function delete($id){

        if(Request::has('post')){

            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token)){


                SubCategory::destroy($id);
                Session::add('success','SubCategory Deleted');
                Redirect::to('/admin/products/categories');

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }


}