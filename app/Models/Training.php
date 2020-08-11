<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use SoftDeletes;x
    
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function achievements(){
        return $this->hasMany(App\Models\Admin\Achievement::class);
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
        return $this->morphMany(App\Models\Like::class);
    }

    public function mentors(){
        return $this->hasMany(App\Models\Admin\Mentor::class);
    }
    
    public function trainingCategory(){
        return $this->belongsTo('App\Models\Admin\TrainingCategory');
    }
}
