<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Notification;
 
trait NotificationTraits {

    public function ShortNotification($type,$name_data,$recipient ){
        
        if ($type == 'multi') {

            Notification::send($recipient, $name_data);

        } elseif ($type == 'single') {
            
            $recipient->notify($name_data);

        } else {
            dd($type . "does not support");
        }

    }

    public function DataNotification($doer_id,$icon,$text,$object_id, $extra_details = null){
        
        $NotificationData = [
            'doer_id'   => $doer_id,
            'icon'      => $icon,
            'text'      => $text,
            'object_id' => $object_id
        ];

        if($extra_details !== null){
            $NotificationData['extra_details'] = $extra_details;
        }

        return $NotificationData;

    }

}