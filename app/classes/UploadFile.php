<?php
/**
 * Created by PhpStorm.
 * User: mayon
 * Date: 01/11/2018
 * Time: 4:38 PM
 */

namespace App\classes;


class UploadFile
{
    protected $filename;
    protected $max_filesize = 2097152;
    protected $extension;
    protected $path;

    //gets the name of the file
    public function getName(){
        return $this->filename;
    }

    //set the name of the file
    protected function setName($file, $name = ""){
        if($name === ""){
            $name = pathinfo($file, PATHINFO_FILENAME);

        }
        //removes spaces and _ from the name
        $name = strtolower(str_replace(['_', ' '], '-', $name));
        //creates a time stamp for the image name
        $hash = md5(microtime());
        $ext = $this->fileExtension($file);
        //concatenate the time stamp on the image name
        $this->filename = "{$name}-{$hash}.{$ext}";

    }
    //set file extension
    protected function fileExtension($file){
        return $this->extension = pathinfo($file, PATHINFO_EXTENSION);


    }
    //validate file size
    public static function fileSize($file){
        $fileobj = new static;
        return $file > $fileobj->max_filesize ? true : false;
    }

    //validate file upload
    public static function isImage($file){

      $fileobj = new static;
      $ext = $fileobj->fileExtension($file);
      $validExt = array('jpg'.'jpeg', 'bmp', 'gif','png');
      if(!in_array(strtolower($ext), $validExt)){
          return false;
      }

      return true;

    }
    //get the image path
    public function path(){
        return $this->path;
    }
    //moves files to intended location
    public static function move($temp_path, $folder, $file, $new_filename = ''){

        $fileobj = new static;
        $ds = DIRECTORY_SEPARATOR;

        $fileobj->setName($file, $new_filename);
        $file_name = $fileobj->getName();
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }

        $fileobj->path = "{$folder}{$ds}{$file_name}";
        $absolute_path = BASE_PATH."{$ds}public{$ds}$fileobj->path";
        if(move_uploaded_file($temp_path, $absolute_path)){
            return $fileobj;
        }
        return null;
    }

}