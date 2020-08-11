<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class App extends Model
{   
    use SoftDeletes;

    public function firebaseTokens(){
        return $this->hasMany(App\Models\Admin\FirebaseTokens::class);
    }

//    public function images(){
//        return $this->hasMany(App\Models\Image::class);
//    }
    
    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }
}


