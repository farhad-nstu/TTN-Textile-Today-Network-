<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function training(){
        return $this->belongsTo(App\Models\Training::class);
    }
}
