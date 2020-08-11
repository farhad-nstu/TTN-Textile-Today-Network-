<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $fillable = ['country_id', 'name'];
    
    public function country(){
        return $this->belongsTo('App\Models\Admin\Country');
    }
    
    public function cities(){
        return $this->hasMany('App\Models\Admin\City');
    }
    
    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
