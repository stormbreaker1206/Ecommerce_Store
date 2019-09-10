<?php
use Philo\Blade\Blade;
use voku\helper\Paginator;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Classes\Session;
use App\Models\User;



function view($path, array $data = [])
{
    $view = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';

    $blade = new Blade($view, $cache);
    echo $blade->view()->make($path, $data)->render();
}

function make ($filename, $data){
    extract($data);
    // turn on output buffering
    ob_start();
    //include template

    include(__DIR__ .'/../../resources/views/emails/' .$filename. '.php');

    //get contents of the file

    $content = ob_get_contents();

    //turn off output buffering and erase contents
    ob_end_clean();
    return $content;

}

function slug($value){
    //remove all characters not in the list: underscore / letters/ numbers / whitespaces
    $value = preg_replace('![^'.preg_quote('_').'\pL\pN\s]+!u','', mb_strtolower($value));

    //replace underscore with a dash
    $value = preg_replace('!['.preg_quote('-').'\s]+!u','-', mb_strtolower($value));

    //remove whitespace

    return trim($value, '-');
}

function paginate($num_of_records, $total_record, $table_name, $object){


    //creates a new instance and accepts parameters
    $pages = new Paginator($num_of_records, 'p');

    //sets the total records
    $pages->set_total($total_record);

    //query the database and return data for pagination and sets a limit
    $data = Capsule::select("SELECT * FROM $table_name where deleted_at IS NULL ORDER BY created_at DESC ". $pages->get_limit());

    //loops through the data and push results into the category array
    $categories = $object->transform($data);
    return [$categories, $pages->page_links()];
}


function isAuthenticated()
{
    return Session::has('SESSION_USER_NAME') ? true : false;
}

function user()
{
    if(isAuthenticated()){
        return User::findOrFail(Session::get('SESSION_USER_ID'));
    }
    return false;
}


function convertMoneyToCents($value)
{
    //remove commas
    $value = preg_replace("/\,/i","",$value);
    $value = preg_replace("/([^0-9\.\-])/i","",$value);

    if(!is_numeric($value)){
        return 0.00;
    }

    $value = (float) $value;
    return round($value, 2) * 100;
}
