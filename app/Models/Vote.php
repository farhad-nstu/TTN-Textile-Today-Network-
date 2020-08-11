<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }
    
    public function votable(){
        return $this->morphTo();
    }
    
}
