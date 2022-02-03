<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteComment extends Notification
{
    use Queueable;

    private $data;


    public function __construct($data)
    {
        $this->data = $data;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

   
    public function toDatabase($notifiable)
    {
        if( array_key_exists('extra_details', $this->data) ) {
            $extra_details = $this->data["extra_details"];
        } else {
            $extra_details = null;
        }
        return [
            'doer_id'       => $this->data["doer_id"],
            'icon'          => $this->data["icon"],
            'text'          => $this->data["text"],
            'extra_details' => $extra_details
        ];
    }
}
