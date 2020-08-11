<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{    
    public function jobs(){
        return $this->hasMany(App\Models\Job::class);
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
