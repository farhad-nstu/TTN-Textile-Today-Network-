<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ConnectionRequestNotification extends Notification
{
    use Queueable;
    public $user;

    public function __construct(User $fromUser)
    {
        $this->user = $fromUser;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->line('The introduction to the notification.')
        ->action('Notification Action', url('/'))
        ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'id'=> $this->user->id,
            'name' => $this->user->name
        ];
    }
}
