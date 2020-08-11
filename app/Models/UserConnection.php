<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserConnection extends Model {

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}