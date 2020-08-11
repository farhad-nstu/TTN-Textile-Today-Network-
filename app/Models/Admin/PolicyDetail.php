<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Policy;

class PolicyDetail extends Model
{
    protected $fillable = [
        'policy_id', 'section_name', 'details', 'mentionable_link', 'status',
    ];
    public function policy(){
        return $this->belongsTo(Policy::class);
    }
}
