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
use App\classes\UploadFile;
use App\classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends BaseController
{
    //create the variables to use for pagination
    public $table_name = 'products';
    public $categories;
    public $products;
    public $subcategories;
    public $subcategories_links;
    public $links;

    //create a constructor method to query the database when
    //this class is instantiated
    public function __construct()
    {
        if(!Role::middleware('admin')){
            Redirect::to('/login');

        }


        //query the category table for all data
        $this->categories = Category::all();
        $total = Product::all()->count();

        list($this->products, $this->links) = paginate(10, $total, $this->table_name, new Product);
        //list the subcategory result in the properties

    }
    //returns the view with an array with the product categories
    //and pagination links
    public function showCreateProductForm(){
        $categories = $this->categories;

        return view('admin/products/create', compact('categories'));

    }

    public function show(){
        $products = $this->products;
        $links = $this->links;
        return view('admin/products/inventory', compact('products','links'));
    }
    //validation and errors process for inserting data
    //to the database

    public function store(){

        if(Request::has('post')){

            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token)){
                //process form data
                $rules = [
                    'name' => ['required' => true, 'minlength' => 3, 'maxlength' => 70, 'string' => true, 'unique'=> $this->table_name],
                    'price' => ['required' => true, 'minlength' =>2, 'number' => true ],
                    'quantity' =>['required' => true],
                    'category' => ['required' => true],
                    'subcategory' => ['required' => true],
                    'description' => ['required' => true, 'mixed' => true,'minlength' => 4, 'maxlength' => 500]

                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                $file = Request::get('file');
                isset($file->productImage->name) ? $filename = $file->productImage->name : $filename = '';

                if(empty($file->productImage->name)){
                    $file_error['productImage'] = array ('The Product Image is required');

                }elseif(!UploadFile::isImage($filename)){
                    $file_error['productImage'] = array ('The Image is Invalid');

                }

                if($validate->hasError()){

                    $response = $validate->getErrorMessages();

                    //counts the errors in file error to merge with getErrorMessages

                    count($file_error) ? $error = array_merge($response, $file_error) : $error = $response;



                    return view('admin/products/create', [

                        'categories' => $this->categories,
                        'errors' => $error,

                    ]);
                }

                $ds = DIRECTORY_SEPARATOR;

                $temp_file = $file->productImage->tmp_name;
                $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();


                Product::create([

                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category,
                    'sub_category_id' => $request->subcategory,
                    'image_path' => $image_path,
                    'quantity' => $request->quantity,



                ]);

                Request::refresh();

                return view('admin/products/create', [

                    'categories' => $this->categories,
                    'success' => 'record created',

                ]);

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }

    /**
     * edit method
     */


    public function showEditProductForm($id){
        //pass the categories data to the form
        $categories = $this->categories;

        //retrieves relational data

        $product = Product::where('id', $id)->with(['category', 'subCategory'])->first();
        return view('admin/products/edit', compact('product', 'categories'));

    }

    public function edit($id){


        if(Request::has('post')){

            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token)){
                //process form data
                $rules = [
                    'name' => ['required' => true, 'minlength' => 3, 'maxlength' => 70, 'string' => true],
                    'price' => ['required' => true, 'minlength' =>2, 'number' => true ],
                    'quantity' =>['required' => true],
                    'category' => ['required' => true],
                    'subcategory' => ['required' => true],
                    'description' => ['required' => true, 'mixed' => true,'minlength' => 4, 'maxlength' => 500,]

                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                $file = Request::get('file');
                isset($file->productImage->name) ? $filename = $file->productImage->name : $filename = '';

                //verifies if the image is set, if set validate image

               if (isset($file->productImage->name) && !UploadFile::isImage($filename)){
                    $file_error['productImage'] = array ('The Image is Invalid');

                }

                if($validate->hasError()){

                    $response = $validate->getErrorMessages();

                    //counts the errors in file error to merge with getErrorMessages

                    count($file_error) ? $error = array_merge($response, $file_error) : $error = $response;



                    return view('admin/products/create', [

                        'categories' => $this->categories,
                        'errors' => $error,

                    ]);
                }

                //retrieve the product information via the id that is being sent from the form

                $product = Product::findOrFail($request->product_id);


                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->sub_category_id = $request->subcategory;
                $product->quantity = $request->quantity;

                if($filename){
                    //if images exist upload image
                    $ds = DIRECTORY_SEPARATOR;
                    //retrieve the path of the old image
                    $old_image_path = BASE_PATH."{$ds}public{$ds}$product->image_path";

                    $temp_file = $file->productImage->tmp_name;
                    $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();

                    //delete old image
                    unlink($old_image_path);

                    //save new image
                    $product->image_path = $image_path;

                }

                $product->save();

                Session::add('success', 'Record Update');
                Redirect::to('/admin/products');




                return view('admin/products/create', [

                    'categories' => $this->categories,
                    'success' => 'record created',

                ]);

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }


    public function delete($id){

        if(Request::has('post')){

            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token)){


                Product::destroy($id);


                Session::add('success','Product Deleted');
                Redirect::to('/admin/products');

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }

    //populate subcategory for selected category
    public function getSubcategories($id){
        $subcategories = SubCategory::where('category_id', $id)->get();

        echo json_encode($subcategories);
        exit;

    }


}