<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Badge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BadgesController extends Controller
{
    public function __construct() {
       $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $badges = Badge::orderBy('id', 'desc')->get();
        return compact('badges', 'status');
    }

    public function store(Request $request)
    {
       $badge = new Badge;

       $badge->title = request('title');
       $badge->color_code = request('color_code');
       $badge->score_needed = request('score_needed');

       //file upload
       if(!empty($request->icon)){

        $strpos = strpos($request->icon,';');
        $sub = substr($request->icon,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = \Image::make($request->icon);
        $upload_path = public_path()."/images/badge_icon/";
        $img->save($upload_path.$name);

       }else{

           $name = 'noimage.jpg';
       }

       $badge->icon = $name;
       $badge->status = request('status');

       $badge->save();

    }

    public function update(Request $request, Badge $badge)
    {

       $badge->title = request('title');
       $badge->color_code = request('color_code');
       $badge->score_needed = request('score_needed');
       $badge->status = request('status');

      //image update
            if(!empty($request->icon)){
                $strpos = strpos($request->icon,';');
                $sub = substr($request->icon,0,$strpos);
                $ex = explode('/',$sub)[1];
                $name = time().".".$ex;
                $img = \Image::make($request->icon);
                $upload_path = public_path()."/images/badge_icon/";
                $image = $upload_path. $badge->icon;
                $img->save($upload_path.$name);

                if(file_exists($image)){
                    @unlink($image);
                }

                }else{

                    $name = $badge->icon;
            }

            $badge->icon = $name;

            $badge->update();
    }


    public function destroy(Badge $badge)
    {
        $image_path = public_path()."/images/badge_icons/";
        $image = $image_path. $badge->icon;
        if(file_exists($image)){
            @unlink($image);
        }
        $badge->delete();
    }
}
