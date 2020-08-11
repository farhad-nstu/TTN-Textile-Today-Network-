<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function users(){
        return $this->belongsToMany(App\Models\User::class);
    }
    
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    
    public function interestGroups(){
        return $this->belongsToMany(App\Models\Admin\InterestGroup::class);
    }

    public function jobType(){
        return $this->belongsTo(App\Models\Admin\JobType::class);
    }

    public function organization(){
        return $this->belongsTo(App\Models\Admin\Organization::class);
    }
    
    public function likes(){
        return $this->morphMany(App\Models\Like::class);
    }
    
    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }    
}
