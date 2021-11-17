<?php

namespace App\Notifications;

use App\Store;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewStoreNotification extends Notification
{
    use Queueable;

    protected $store;
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable){
        return[
            'data' => 'منشأه جديده'. ' ' .$this->store->name,
            'created_at' => $this->store->created_at,
        ];
    }


    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'data' => 'new store ' . $this->store->name,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'data' => 'new store' . $this->store->name,
        ];
    }
}
