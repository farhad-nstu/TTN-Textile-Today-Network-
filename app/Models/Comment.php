<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CommentNotification;
use App\Models\User;
class Comment extends Model
{
    use SoftDeletes;

    // if(Share::insert($shareData)){
    //     if(!Post::insert($postData)){
    //         Share::where('user_id',$userId)->where('shareable_id',$shareableId)->where('shareable_type',$shareableType)->orderBy('id',"DESC")->first()->delete();
    //         $result['response'] = 'error';
    //         $result['message'] = 'Sorry, Shared failed! Please try again.';
    //     }
    // }else{
    //     $result['response'] = 'error';
    //     $result['message'] = 'Sorry, Shared failed! Please try again.';
    // }
    public static function generic_method_for_comment($userId,$commnetableId,$commnetableType,$comment){
        $result['response'] = 'success';
        $data= ['user_id'=>$userId, 'commentable_type'=> $commnetableType,'commentable_id'=> $commnetableId, 'comment' => $comment, 'created_at'=>now()];
        $comment = Comment::insert($data);
        if($comment){
            // dd($comment);
            // $user = User::find($userId);
            // $user->notify(new CommentNotification($comment)); 
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Comment  failed! Please try again.';
        }
        return $result; 
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function commentable(){
        return $this->morphTo();
    }

    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }

    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }
    public function likes(){
        return $this->morphMany('App\Models\Like','likeable');
    }
}
