<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    
    public function states(){
        return $this->hasMany('App\Models\Admin\State');
    }
    
    public function cities(){
        return $this->hasMany('App\Models\Admin\Cities');
    }
    
    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
