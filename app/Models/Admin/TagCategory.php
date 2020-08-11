<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model {
    
    public function tags(){
        return $this->hasMany('App\Models\Admin\Tag');
    }
}
