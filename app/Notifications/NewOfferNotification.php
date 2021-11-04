<?php

namespace App\Notifications;

use App\Offer;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOfferNotification extends Notification
{
    use Queueable;

    protected $offer;
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable){
        return[
            'data' => ' عرض جديد '  . $this->offer->name,
            'created_at' => $this->offer->created_at,
        ];
    }


    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'data' => 'new offer ' . $this->offer->name,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'data' => 'new offer' . $this->offer->name,
        ];
    }
}
