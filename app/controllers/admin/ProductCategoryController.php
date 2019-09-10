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

class ProductCategoryController extends BaseController
{

    //create the variables to use for pagination
    public $table_name = 'categories';
    public $categories;
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
        $total = Category::all()->count();

        //query the subcategory table for all data
        $subTotal = SubCategory::all()->count();
        $object = new Category;
        //list the category result in the properties
        list($this->categories, $this->links) = paginate(4, $total, $this->table_name, $object);
        //list the subcategory result in the properties
        list($this->subcategories, $this->subcategories_links) = paginate(4, $subTotal, 'sub_categories', new SubCategory );

    }
    //returns the view with an array with the product categories
    //and pagination links
    public function show(){

        return view('admin/products/categories', [

            'categories' => $this->categories,
            'links' => $this->links,
            'subcategories' => $this->subcategories,
            'subcategories_links' => $this->subcategories_links
        ]);

    }
    //validation and errors process for inserting data
    //to the database

    public function store(){

        if(Request::has('post')){

            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token)){
                //process form data
                $rules = [
                    'name' => ['required' => true, 'minlength' => 3, 'string' => true, 'unique'=> 'categories']
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                if($validate->hasError()){

                    $error = $validate->getErrorMessages();
                    return view('admin/products/categories', [

                        'categories' => $this->categories,
                        'links' => $this->links,
                        'errors' => $error,
                        'subcategories' => $this->subcategories,
                        'subcategories_links' => $this->subcategories_links
                    ]);
                }


                Category::create([

                    'name' => $request->name,
                    //remove all characters using the helper.php function
                    'slug' => slug($request->name)
                ]);
                $total = Category::all()->count();
                list($this->categories, $this->links) = paginate(4, $total, $this->table_name, new Category);

                //query the subcategory table for all data
                $subTotal = SubCategory::all()->count();

                //list the subcategory result in the properties
                list($this->subcategories, $this->subcategories_links) = paginate(4, $subTotal, 'sub_categories', new SubCategory );


                return view('admin/products/categories', [

                    'categories' => $this->categories,
                    'links' => $this->links,
                    'success' => 'category created',
                    'subcategories' => $this->subcategories,
                    'subcategories_links' => $this->subcategories_links
                ]);

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }

    /**
     * edit method
     */

    public function edit($id){

        if(Request::has('post')){

            $request = Request::get('post');


            if(CSRFToken::verifyCSRFToken($request->token, false)){
                //process form data
                $rules = [
                    'name' => ['required' => true, 'minlength' => 3, 'string' => true, 'unique'=> 'categories']
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                if($validate->hasError()){

                    $error = $validate->getErrorMessages();
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($error);
                    exit;
                }

                Category::where('id', $id)->update(['name' => $request->name]);
                echo json_encode(['success' => 'Record Updated']);
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

                //delete the main category
                Category::destroy($id);

                //retrieves all the sub category under a main category
                $subcategories = SubCategory::where('category_id', $id)->get();

                if(count($subcategories)){
                    foreach ($subcategories as $subcategory){
                        //delete all subcategory under a main category
                        $subcategory->delete();
                    }

                }

                Session::add('success','Category Deleted');
                Redirect::to('/admin/products/categories');

            }
            throw new \Exception('Token mismatch');
        }

        return null;

    }


}