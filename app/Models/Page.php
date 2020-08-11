<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    
    public function users(){
        return $this->belongsToMany(App\Models\User::class);
    }

    public function page_category(){
        return $this->belongsTo(App\Models\PageCategory::class);
    }
    
    public function images(){
        return $this->morphMany('App\Models\Image','imagable');
    }
    
    public function invitations(){
        return $this->morphMany('App\Models\Invitation','invitationable');
    }
    
    public function likes(){
        return $this->morphMany(App\Models\Like::class);
    }
    
    public function posts(){
        return $this->morphMany('App\Models\Post', 'postable');
    }    
}
