<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ClassifiedCategory extends Model
{
    public function classifieds(){
        return $this->hasMany(App\Models\Classified::class);
    }
}
