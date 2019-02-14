<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Auth;
use App\Ups;

class UpsStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ups;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Ups $ups)
    {
        $this->ups = $ups;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('upsstatus');
    }

    public function broadcastWith()
    {
        return [
            'ups_id' => $this->ups->id,
            'ups_stato' => $this->ups->stato,
            'ups_numero_serie' => $this->ups->numero_serie
        ];
    }

}
