<?php

namespace App\Models;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Share extends Model {
    
    public static function generic_method_for_share($userId, $shareableId, $shareableType, $description){
        $result['response'] = 'success';
        $shareData= ['user_id'=>$userId, 'shareable_type'=> $shareableType,'shareable_id'=> $shareableId,'shared_at' => now()];
        $postData= ['user_id'=>$userId, 'post_type_id'=>0, 'postable_type'=> $shareableType,'postable_id'=> $shareableId,'descr' => $description,'status'=>10];
        if(Share::insert($shareData)){
            if(!Post::insert($postData)){
                Share::where('user_id',$userId)->where('shareable_id',$shareableId)
                    ->where('shareable_type',$shareableType)->orderBy('id',"DESC")
                    ->first()->delete();
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Shared failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Shared failed! Please try again.';
        }
        return $result;
    }

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function shareable(){
        return $this->morphTo();
    }
}
