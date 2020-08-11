<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
   protected $fillable = ['title', 'type_code', 'status'];
   
   public function posts(){
        return $this->hasMany(App\Models\Post::class);
    }
}
