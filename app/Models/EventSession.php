<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    public function event(){
        return $this->belongsTo(App\Models\Admin\Event::class);
    }
}
