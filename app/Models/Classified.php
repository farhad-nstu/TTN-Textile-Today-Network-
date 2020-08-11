<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classified extends Model
{
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function classified_category(){
        return $this->belongsTo(App\Models\Admin\ClassifiedCategory::class);
    }

    public function interestGroups(){
        return $this->belongsToMany(App\Models\Admin\InterestGroup::class);
    }
    
    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }
    
    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }
    
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
