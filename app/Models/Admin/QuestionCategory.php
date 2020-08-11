<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    public function questions(){
        return $this->hasMany('App\Models\Question');
    }    
}
