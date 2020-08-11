<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public function users(){
        return $this->belongsToMany(App\Models\User::class);
    }   
    
    public function achievements(){
        return $this->hasMany(App\Models\Achievement::class);
    }
}
