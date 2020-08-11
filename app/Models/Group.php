<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users(){
        return $this->hasMany(App\Models\User::class);
    }
    
    public function flags(){
        return $this->morphMany('App\Models\Flag', 'flaggable');
    }
    
    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }
    
    public function invitations(){
        return $this->morphMany('App\Models\Invitation','invitationable');
    }

    public function posts(){
        return $this->hasMany(App\Models\Admin\Post::class);
    }
}
