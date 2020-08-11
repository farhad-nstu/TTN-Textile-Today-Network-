<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model {

    public function imagable(){
        return $this->morphTo();
    }

    // var $uploadPath;
    public $allowedFileTypes = array(
        'image/jpg', 'image/jpeg', 'image/JPG', 'image/JPEG',
        'image/png', 'image/PNG', 'image/gif', 'image/GIF',
        'application/zip',
        'application/octet-stream',
        'application/x-zip-compressed',
        'audio/mpeg','audio/mp3',
        'application/pdf'
    ); 
    
    protected static function _check_file_type($fileData){
        return 'image';
    }

    public static function upload_file($fileData, $userId, $fileName = '', $modelName = '', $createThumb = false){
        $result['response'] = 'success';
        $filePath = 'public/uploads/'.$userId.'/'.$modelName;
        if($fileData && $userId && $modelName){
            if( !Storage::disk('local')->has($filePath) ){
                Storage::disk('local')->makeDirectory($filePath, 755, true);
            }
            $fileType = Image::_check_file_type($fileData);

            if($fileType) {
                switch($fileType) {
                    case 'image':
                        $decodedFile = \Image::make($fileData);
                        $extension = substr($decodedFile->mime, strpos($decodedFile->mime, '/')+1, strlen($decodedFile->mime));
                        $fileName = time().Image::sanitize($fileName).'.'.$extension; //url may get broken without sanitize
                        $fileName = str_replace(' ', '-', $fileName);

                        if( $decodedFile->save( storage_path('app/'.$filePath .'/'. $fileName) ) ){
                            $result['file_name'] = $fileName;

                            if ($createThumb) {
                                $createThumbResponse = Image::create_thumb($fileData, $filePath, $fileName);
                                
                                if($createThumbResponse['response']=='error'){
                                    $result['response'] = 'error';
                                    $result['message'] = 'File upload failed! Thumb creation failed.';
                                    @unlink( storage_path('app/'.$filePath .'/'. $fileName) );
                                }
                            }
                        }else{
                            $result['response'] = 'error';
                            $result['message'] = 'File upload failed!';
                        }
                    break;
    
                    case 'pdf':
                    break;
                }
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Invalid file type! Uploaded file type is not supported';
            }            
        }else{
            $result['response'] = 'error';
            $result['message'] = 'File or user id or model name can not be empty';
        }        
        return $result;
    }

    public static function create_thumb($fileData, $filePath, $fileName, $width = 160, $height = 120) {

        $result['response'] = 'success';

        if( !Storage::disk('local')->has($filePath.'/thumbs') ){
            Storage::disk('local')->makeDirectory($filePath.'/thumbs', 0755, true);
        }

        $arr_image_details = getimagesize(storage_path('app/'.$filePath .'/'. $fileName));
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];

        $widthHeightRatio = (1.0 * $original_width) / $original_height;

        if($original_height > $original_width && $width > $height){
            $tmpHeight = $height;
            $height = $width;
            $width = $tmpHeight;
        }

        $decodedFile = \Image::make($fileData)->resize($width, $height);
        if( !$decodedFile->save( storage_path('app/'.$filePath .'/thumbs'.'/'. $fileName) ) ){
            $result['response'] = 'error';
            $result['message'] = 'Thumb creation failed! Please try again.';
        }
        return $result;
    }

    public static function sanitize($string, $force_lowercase = false, $onlyAlphaNumeric = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($onlyAlphaNumeric) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        return ($force_lowercase) ?
                (function_exists('mb_strtolower')) ?
                        mb_strtolower($clean, 'UTF-8') :
                        strtolower($clean) :
                $clean;
    }
}
