<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $title;
    public $type;
    public $date;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        if($data['type'] == 'newStore'){
            $type = 'منشأه جديده';
            $this->title = $data['info']['name'];

        }elseif ($data['type'] == 'newCar'){
            $type = 'سيارة جديده';
            $this->title = $data['info']['number'];
        }elseif ($data['type'] == 'newOffer'){
            $type = 'عرض جديد';
            $this->title = $data['info']['name'];
        }
        $created_at = $data['info']['created_at']->calendar();
        $this->id = $data['info']['id'];
        $this->type = $type;
        $this->date =  $created_at;
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['new-notification'];

    }

}
