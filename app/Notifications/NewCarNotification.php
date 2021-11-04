<?php

namespace App\Notifications;

use App\Car;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCarNotification extends Notification
{
    use Queueable;

    protected $car;
    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable){
        return[
            'data' => 'سيارة جديده'. ' ' .$this->car->number,
            'created_at' => $this->car->created_at,
        ];
    }


    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'data' => 'new car' . $this->car->number,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'data' => 'new car' . $this->car->number,
        ];
    }
}
