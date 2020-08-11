<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class InterestGroup extends Model
{
    public function classifieds(){
        return $this->belongsToMany(App\Models\Classifieds::class);
    }

    public function events(){
        return $this->belongsToMany(App\Models\Event::class);
    }

    public function jobs(){
        return $this->belongsToMany(App\Models\Job::class);
    }

    public function posts(){
        return $this->belongsToMany(App\Models\Post::class);
    }

    public function trainings(){
        return $this->belongsToMany(App\Models\Training::class);
    }
    
    public function users(){
        return $this->belongsToMany(App\Models\User::class);
    }
}
