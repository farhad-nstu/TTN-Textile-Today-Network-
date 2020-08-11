<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models;
class Policy extends Model
{
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

    public function policy_details(){
        return $this->hasMany('App\Models\Admin\PolicyDetail');
    }

}
