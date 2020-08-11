<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function services(){
        return $this->belongsToMany('App\Models\Admin\UserType');
    }
}
