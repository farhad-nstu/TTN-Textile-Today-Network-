<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
