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
class SubCategory extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    protected $fillable =['name', 'slug','category_id'];
    protected $dates = ['deleted_at'];

    public function category(){
        // a sub category belongs to a category
        return $this->belongsTo(Category::class);
    }

    public function product(){
        // a sub category can have many products
        return $this->hasMany(Product::class);
    }





    public function transform($data){
        //creates an empty array
        $subcategories = [];
        foreach ($data as $item){
            $added = new Carbon($item->created_at);
            array_push($subcategories,[
                'id' => $item->id,
                'category_id' => $item->category_id,
                'name' => $item->name,
                'slug' => $item->slug,
                'added' => $added->toFormattedDateString()

            ]);
        }

        return $subcategories;
    }

}