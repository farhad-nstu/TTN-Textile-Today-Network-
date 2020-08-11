<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Like extends Model
{

    public static function unlike_for_all($user_id, $likeable_id, $likeable_type){
        $result['response'] = 'success';
        $unlike = Like::where('user_id',$user_id)->where('likeable_type',$likeable_type)->where('likeable_id',$likeable_id)->first();
        if($unlike->delete()){
            $result['message'] = "unliked has been successfull!";
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, unliked failed! Please try again.';
        }
        return $result;
    }
    public static function like_for_all($user_id, $likeable_id, $likeable_type){
        $result['response'] = 'success';
        $like = ['user_id'=>$user_id, 'likeable_type'=> $likeable_type,'likeable_id'=> $likeable_id];
        if(Like::insert($like)){
            $result['message'] = "Liked has been successfull!";
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Liked failed! Please try again.';
        }
        return $result;
    }


    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function likable(){
        return $this->morphTo();
    }

//    public function post(){
//        return $this->belongsTo(App\Models\Admin\Post::class);
//    }
//
//    public function job(){
//        return $this->belongsTo(App\Models\Admin\Job::class);
//    }
//
//    public function training(){
//        return $this->belongsTo(App\Models\Admin\Training::class);
//    }
//
//    public function event(){
//        return $this->belongsTo(App\Models\Admin\Event::class);
//    }
//
//    public function page(){
//        return $this->belongsTo(App\Models\Admin\Page::class);
//    }
}
