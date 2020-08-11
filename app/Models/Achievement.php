<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function badge(){
        return $this->belongsTo(App\Models\Admin\Badge::class);
    }

    public function training(){
        return $this->belongsTo(App\Models\Training::class);
    }
}
