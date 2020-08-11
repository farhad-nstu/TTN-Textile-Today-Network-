<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models;
// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable {
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'phone', 'status','verified_token'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interestGroups(){
        return $this->belongsToMany(App\Models\Admin\InterestGroup::class);
    }

    public function languages(){
        return $this->belongsToMany(App\Models\Admin\Language::class);
    }

    public function access_points(){
        return $this->hasMany(App\Models\Admin\AccessPoint::class);
    }

    public function badges(){
        return $this->hasMany(App\Models\Admin\Badge::class);
    }
    public function achievements(){
        return $this->hasMany(App\Models\Admin\Achievement::class);
    }

    public function activity_logs(){
        return $this->hasMany(App\Models\Admin\ActivityLog::class);
    }

    public function billing_info(){
        return $this->hasMany(App\Models\Admin\BillingInfo::class);
    }

    public function classifieds(){
        return $this->hasMany(App\Models\Admin\Classified::class);
    }
    public function comments(){
        return $this->hasMany(App\Models\Admin\Comment::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function events(){
        return $this->belongsToMany(Event::class);
    }

    public function eventUser(){
        return $this->belongsToMany(EventUser::class);
    }
    public function groups(){
        return $this->hasMany(App\Models\Group::class);
    }

    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }

    public function jobs(){
        return $this->belongsToMany(App\Models\Admin\Job::class);
    }

    public function likes(){
        return $this->hasMany(App\Models\Admin\Like::class);
    }

    public function mentors(){
        return $this->hasMany(App\Models\Admin\Mentor::class);
    }

    public function votes(){
        return $this->hasMany(App\Models\Admin\Vote::class);
    }

    public function organizations(){
        return $this->belongsToMany('App\Models\Organization');
    }

    public function pages(){
        return $this->belongsToMany(App\Models\Page::class);
    }

    public function policies(){
        return $this->hasMany(App\Models\Admin\Policy::class);
    }

    public function posts(){
        return $this->morphMany('App\Models\Post', 'postable');
    }

    public function skills(){
        return $this->belongsToMany('App\Models\Admin\Skill');
    }
    public function shares(){
        return $this->hasMany('App\Models\Share');
    }

    public function userConnections(){
        return $this->hasMany('App\Models\UserConnection');
    }

    public function videos(){
        return $this->hasMany('App\Models\Video');
    }

    public function wishlists(){
        return $this->hasMany('App\Models\Wishlist');
    }

    public function working_histories(){
        return $this->hasMany('App\Models\WorkingHistory');
    }

    public function country(){
        return $this->belongsTo('App\Models\Admin\Country');
    }

    public function city(){
        return $this->belongsTo('App\Models\Admin\City');
    }

    public function state(){
        return $this->belongsTo('App\Models\Admin\state');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }
}
