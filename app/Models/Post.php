<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Support\Str;
use DB;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function post_type(){
        return $this->belongsTo('App\Models\Admin\PostType');
    }

    public function postable(){
        return $this->morphTo();
    }

    public function group(){
        return $this->belongsTo(App\Models\Admin\Group::class);
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }

    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }

    public function interestGroups(){
        return $this->belongsToMany(App\Models\Admin\InterestGroup::class);
    }

    public function likes(){
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    public function shares(){
        return $this->hasMany('App\Models\Share');
    }

    public static function get_posts($userId, $limit, $page){
        $connectedUsersId = UserConnection::select('connection_id')->where('user_id', $userId)
            ->where('is_accepted', '1')->where('blocked', '0')->get();

        $articles = Post::select('id', 'title', 'descr', 'user_id', 'post_type_id', 
            'created_at', 'total_like', 'total_comment')->with(array(
                'user' => function($query){
                    $query->select('id','name', 'profile_picture');
                },
                'comments' => function($query){
                    $query->with(array(
                        'user' => function($query){
                        $query->select('id','name', 'profile_picture');
                    }))->orderBy('id', 'DESC')->limit(2);
                },
                'likes' => function($query){
                    $query->select('user_id', 'likeable_id');
                }))->orderBy('created_at', 'desc')->whereIn('user_id', $connectedUsersId)
           ->orwhere('user_id', $userId)
           ->orwhere('status', 10)->paginate($limit);

        foreach($articles as $article){
            $article->descr = Str::limit(strip_tags($article->descr, 40));
        }
        return $articles;

    }
}