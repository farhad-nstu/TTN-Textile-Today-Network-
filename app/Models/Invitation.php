<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{

    public static function generic_method_for_invitation($invitedBy, $invitedTo, $invitationType, $invitationableId){
        $result['response'] = 'success';
        foreach($invitedTo as  $i => $userId) {
            $data[$i]= [
                'invited_by'=>$invitedBy, 'invited_to'=> $userId,
                'invitationable_type'=> $invitationType, 
                'invitationable_id' =>  $invitationableId, 'invited_at' => now()
            ];
        }
        if(!Invitation::insert($data)){            
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Invitation failed! Please try again.';
        }
        return $result;
    }
    
    public function invitationable(){
        return $this->morphTo();
    }
}
