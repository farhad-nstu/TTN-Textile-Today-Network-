<?php
namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller {   

    public function __construct(){
        $this->middleware('auth:api');        
    }

    public function store(Request $request) {
        if(!empty($request->image)){
            $result = $this->upload_file($request->image, $request->user_id, 'Image', true);
            if($result['response'] == 'success'){
                $image = new Image;
                $image->image = $result['file_name'];
                $image->imagable_id = "1";
                $image->imagable_type = "App\Post";
                $image->caption = "Post Image";
                $image->save();                
            }
            return compact('result');            
        }else{
            dd("im empty");
        }
    }

    // public function store(Request $request) {
    //     if(!empty($request->image)){
    //         $image = new Image;
    //         $strpos = strpos($request->image,';');
    //         $sub = substr($request->image,0,$strpos);
    //         $ex = explode('/',$sub)[1];
    //         $name = time().".".$ex;
    //         $img = \Image::make($request->image);
    //         $upload_path = public_path()."/images/post_images/";
    //         $img->save($upload_path.$name);
    //         $image->image = $name;
    //         $image->imagable_id = "1";
    //         $image->imagable_type = "App\Post";
    //         $image->caption = "Test Image";
    //         $image->save();
    //         return compact('name');
    //     }else{
    //         dd("im empty");
    //     }
    // }
}
