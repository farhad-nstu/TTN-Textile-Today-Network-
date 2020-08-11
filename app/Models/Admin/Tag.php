<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    
    public function tagCategory(){
        return $this->belongsTo('App\Models\Admin\TagCategory');
    }
}
