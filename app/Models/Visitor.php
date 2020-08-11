<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Visitor;
use Carbon\Carbon;
use App\Models\Admin\Setting;

class Visitor extends Model {

    protected $fillable = [
        'source_ip', 'visitorable_type', 'visitorable_id', 'visited_at'
    ];

    public function visitorable(){
        return $this->morphTo();
    }
    public static function should_increase_view_count($source_ip, $visitorable_type, $visitorable_id)
    {
        $visitor = DB::table('visitors')
                        ->where([
                            'source_ip'=>$source_ip,'visitorable_type'=>$visitorable_type,
                            'visitorable_id'=>$visitorable_id
                            ])
                        ->orderBy('id','DESC')->first();
        if($visitor){
            $uniqueViewInterval = Setting::get_code_value_by_name('unique_view_interval');
            if($uniqueViewInterval !== null){
                $timeDifference = (int) (time() - strtotime($visitor->visited_at)) /3600;

                if ( $timeDifference >= $uniqueViewInterval) {  // 24h
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    public static function store_view_history($source_ip, $visitorable_type, $visitorable_id)
    {
        $insert_data                   = new Visitor();
        $insert_data->source_ip        = $source_ip;
        $insert_data->visitorable_type = $visitorable_type;
        $insert_data->visitorable_id   = $visitorable_id;
        $insert_data->visited_at       = Carbon::now();
        $insert_data->save();
    }
}
