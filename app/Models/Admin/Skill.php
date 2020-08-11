<?php

namespace App\Models\Admin;
use App\Models;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model {
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'skill_user');
    }
}
