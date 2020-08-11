<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
use App\Models;

class Question extends Model
{
    protected $fillable = [
        'question_category_id', 'created_by', 'title', 'details', 'id_faq', 'up_vote', 'down_vote', 'total_flag', 'total_view', 'status'
    ];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function question_category(){
        return $this->belongsTo('App\Models\Admin\QuestionCategory');
    }
    
    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }
    
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function visitors(){
        return $this->morphMany('App\Models\Visitor', 'visitorable');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'created_by'); //pass parameter which is used in question table as created_by
    }

    public function votes(){
        return $this->morphMany('App\Models\Vote', 'votable');
    }
}
