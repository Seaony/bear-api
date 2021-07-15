<?php

namespace App\Events;

use App\Models\Egg;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EggCracked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $egg;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Egg $egg)
    {
        $this->egg = $egg;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
