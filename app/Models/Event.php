<?php

namespace App\Models;
use \Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Event extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function add_interest_group($interest_group_ids, $event){
        foreach($interest_group_ids as $interest_group_id){
            $event->interestGroups()->attach($interest_group_id);
        }
        $result['response'] = 'success';
        $result['message'] = 'Interest group added successfull';
    }
    public static function add_mentor_list($mentors, $user_id, $event){
        $checkCreator = false;
        foreach($mentors as $mentor){
            $mentor = (object) $mentor;
            if($mentor->id == $user_id){
                $event->user()->attach($mentor->id, ['is_mentor' => 1,'is_creator'=> 1]);
                $checkCreator = true;
            }else{
                $event->user()->attach($mentor->id, ['is_mentor' => 1,'is_creator'=> 0]);
            }
        }
        if($checkCreator == false){
            $event->user()->attach($user_id, ['is_mentor' => 0,'is_creator'=> 1 ]);
        }
        $result['response'] = 'success';
        $result['message'] = 'Mentors added successfull';
    }

    public static function get_events($userId, $limit, $page){
        $events = Event::select('id', 'title', 'details', 'start_date', 'contact_email', 'contact_phone_no', 'venue', 'created_at')->paginate(2);
        foreach($events as $event){
            $event->details = Str::limit($event->details, 200);
            $event['likes'] = \App\Models\Like::where('likeable_id', $event->id)->count();
            $checkLikedID = \App\Models\Like::where('user_id', $userId)->where('likeable_id', $event->id)->where('likeable_type', 'App\Models\Event')->count();
            if($checkLikedID == 0){
                $event['is_liked'] = false;
            }else{
                $event['is_liked'] = true;
            }
           // $result->created_at = (strtotime(now()) - strtotime($result->created_at)) /3600;
        }
        return $events;
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function event_type(){
        return $this->belongsTo(App\Models\Admin\EventType::class);
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function interestGroups(){
        return $this->belongsToMany('App\Models\Admin\InterestGroup');
    }

    public function event_sessions(){
        return $this->hasMany(App\Models\Admin\EventSession::class);
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
