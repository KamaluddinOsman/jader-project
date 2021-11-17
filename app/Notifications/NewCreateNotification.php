<?php

namespace App\Notifications;

use App\Store;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCreateNotification extends Notification
{
    use Queueable;

    protected $notifyroomnumber;
    /**
     * @var \App\Notification
     */

    public function __construct($notifyroomnumber)
    {
        $this->notification = $notifyroomnumber;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable){
        return[
            'data' => $this->notifyroomnumber,
        ];
    }


    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'data' => 'new store' . $this->notifyroomnumber,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'data' => 'new store' . $this->notifyroomnumber,
        ];
    }
}
