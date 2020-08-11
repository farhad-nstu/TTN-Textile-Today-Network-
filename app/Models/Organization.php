<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
//    public function user(){
//        return $this->belongsTo(App\Models\User::class);
//    }
    
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
    
    public function jobs(){
        return $this->hasMany(App\Models\Job::class);
    }

}
