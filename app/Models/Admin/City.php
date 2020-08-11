<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    protected $fillable = ['country_id', 'state_id', 'name', 'lattitude', 'longtitude'];
    
    public function country(){
        return $this->belongsTo('App\Models\Admin\Country');
    }
    
    public function state(){
        return $this->belongsTo('App\Models\Admin\State');
    }
    
    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
