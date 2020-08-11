<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    public function jobs(){
        return $this->hasMany(App\Models\Job::class);
    }
}
