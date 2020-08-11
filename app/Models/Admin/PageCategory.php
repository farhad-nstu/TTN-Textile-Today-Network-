<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    public function pages(){
        return $this->hasMany(App\Models\Admin\Page::class);
    }
}
