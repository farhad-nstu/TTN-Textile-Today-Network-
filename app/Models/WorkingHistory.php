<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class WorkingHistory extends Model {

    protected $fillable = ['user_id','job_title', 'company_name','responsibilities','joined_at','left_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
