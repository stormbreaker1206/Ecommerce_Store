<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 05/11/2018
 * Time: 4:03 PM
 */

namespace App\classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    private static $error = [];
    private static $Error_messages = [

        'string' => 'The :attribute field cannot contain numbers',
        'required' => 'The :attribute field is required',
        'minlength' => 'The :attribute field must be a minimum of :policy characters',
        'maxlength' => 'The :attribute field must be a maximum of :policy characters',
        'mixed' => 'The :attribute field can letters, numbers, dash and space only',
        'number' => 'The :attribute field cannot contain letters e.g. 20.0, 20',
        'email' => 'Email address is not valid',
        'unique' => 'The :attribute is already taken, please try another one'

    ];
    /**
     * @param array $dataAndValues
     * @param array $policies
     */

    public function abide(array $dataAndValues, array $policies){
        foreach ($dataAndValues as $column => $value){

            if(in_array($column, array_keys($policies))){

                //do validation

                self::doValidation([

                    'column' => $column,'value' => $value,'policies' => $policies[$column]]);
            }
        }



    }

    /** perform validation and set error messages
     * @param array $data
     */

    private static function doValidation(array $data){

        $column = $data['column'];
        foreach ($data['policies'] as $rule => $policy){
            $valid = call_user_func_array([self::class, $rule],[$column, $data['value'], $policy ]);
            if(!$valid){
              self::setError(
                  str_replace([':attribute',':policy', '_'],
                      [$column, $policy, ' ' ],
                      self::$Error_messages[$rule]), $column
              );


            }


        }


    }

    /**
     * @param $column, field name or column name
     * @param $value, value passed into the form
     * @param $policy, rule that is set, eg min length = 5
     * @return bool, returns true or false
     */
    protected static function unique($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            return !Capsule::table($policy)->where($column, '=', $value)->exists();

        }

        return true;
    }

    protected static function required($column, $value, $policy){

        return $value !== null && !empty(trim($value));
    }



    protected static function minlength($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            return strlen($value) >= $policy;

        }

        return true;

    }

    protected static function maxlength($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            return strlen($value) <= $policy;

        }

        return true;

    }

    protected static function email($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            return filter_var($value, FILTER_VALIDATE_EMAIL);

        }

        return true;
    }

    protected static function mixed($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            if(!preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value)){

                return false;
            }

        }

        return true;
    }

    protected static function string($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            if(!preg_match('/^[A-Za-z ]+$/', $value)){

                return false;
            }

        }

        return true;


    }

    protected static function number($column, $value, $policy){

        if($value != null && !empty(trim($value))){

            if(!preg_match('/^[0-9. ]+$/', $value)){

                return false;
            }

        }

        return true;

    }

    /**
     * @param $error set specific error messages
     * @param null $key
     */

    private static function setError($error, $key = null){
        if($key){

            self::$error[$key][] = $error;
        }else{
            self::$error[] = $error;
        }

    }

    /**
     * @return bool return true if there is validation error
     */


    public function hasError(){
        return count(self::$error) > 0 ? true : false;
    }

    /**
     * @return array return all validation errors
     */
    public function getErrorMessages(){
        return self::$error;

    }

}