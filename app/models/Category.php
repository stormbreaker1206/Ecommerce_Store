<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 01/11/2018
 * Time: 11:40 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Category extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    protected $fillable =['name', 'slug'];
    protected $dates = ['deleted_at'];

    //defining the relationship between tables

    public function products(){
        // The Category table can have many products.. use plural for many to many
        return $this->hasMany(Product::class);
    }

    public function subCategories(){
        //The Category table can have many sub categories
        return $this->hasMany(SubCategory::class);
    }



    public function transform($data){
        //creates an empty array
        $categories = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            array_push($categories,[
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'added' => $added->toFormattedDateString()

            ]);
        }

        return $categories;
    }

}