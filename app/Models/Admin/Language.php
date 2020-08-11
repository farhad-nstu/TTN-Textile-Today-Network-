<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function users(){
        return $this->belongsToMany(App\Models\User::class);
    }

}
