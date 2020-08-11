<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;



class AccessPoint extends Model
{
    
    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function activityLogs(){
        return $this->hasMany('App\Models\ActivityLog');
    }
    
}
