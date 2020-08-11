<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\User;

class Answer extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
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

    public function votes(){
        return $this->morphMany('App\Models\Vote', 'votable');
    }
}
