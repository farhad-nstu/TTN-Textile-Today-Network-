<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model{
    
    public function trainings(){
        return $this->hasMany('App\Models\Training');
    }
}
