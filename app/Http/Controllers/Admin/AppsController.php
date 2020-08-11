<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class AppsController extends Controller
{
    public function __construct(){
       $this->middleware('auth:api');
    }    

    public function index()
    {
        $apps = App::orderBy('id', 'desc')->get();
        return $apps;
    }

    public function store(Request $request)
    {
        //   $request->validate([
        //     'access_point_name' => 'required|max:200',
        //     'unique_code' => 'required|100',
        //     'status' => 'max:1|required',
        // ]);

        $app = new App;

        $app->platform_id = request('platform_id');
        $app->title = request('title');
        $app->package_name = request('package_name');
        $app->short_descr = request('short_descr');
        $app->descr = request('descr');


        $strpos = strpos($request->logo,';');
        $sub = substr($request->logo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = \Image::make($request->logo);
        $upload_path = public_path()."/images/apps_logo/";
        $img->save($upload_path.$name);

        $app->logo = $name;
        $app->promo_video_link = request('promo_video_link');
        $app->firebase_api_key = request('firebase_api_key');

        $app->save();
    }


    public function update(Request $request, App $app)
    {
        
        //   $request->validate([
        //     'access_point_name' => 'required|max:200',
        //     'unique_code' => 'required|100',
        //     'status' => 'max:1|required',
        // ]);


        $app->platform_id = request('platform_id');
        $app->title = request('title');
        $app->package_name = request('package_name');
        $app->short_descr = request('short_descr');
        $app->descr = request('descr');

        if(!empty($request->logo)){
            $strpos = strpos($request->logo,';');
            $sub = substr($request->logo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = \Image::make($request->logo);
            $upload_path = public_path()."/images/apps_logo/";
            $image = $upload_path. $app->logo;
            $img->save($upload_path.$name);

            if(file_exists($image)){
                @unlink($image);
            }

            }else{

                $name = $app->logo;
            }
            
            $app->logo = $name;
            $app->promo_video_link = request('promo_video_link');
            $app->firebase_api_key = request('firebase_api_key');

            $app->save();

    }

    public function destroy(App $app)
    {   
        $image_path = public_path()."/images/apps_logo/";
        $image = $image_path. $app->logo;
        if(file_exists($image)){
            @unlink($image);
        }
        $app->delete();
    }
}
