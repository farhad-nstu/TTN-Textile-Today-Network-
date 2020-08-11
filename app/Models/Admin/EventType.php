<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    public function events(){
        return $this->hasMany(App\Models\Admin\Event::class);
    }

    
}
