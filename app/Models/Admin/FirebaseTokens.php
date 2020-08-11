<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FirebaseTokens extends Model
{
    public function app(){
        return $this->belongsTo(App\Models\Admin\App::class);
    }
}
