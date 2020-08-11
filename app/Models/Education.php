<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;
class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = ['user_id','institute_name', 'degree_name','passing_year','cgpa'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
