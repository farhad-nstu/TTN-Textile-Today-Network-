<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function access_point(){
        return $this->belongsTo(App\Models\Admin\AccessPoint::class);
    }
}
