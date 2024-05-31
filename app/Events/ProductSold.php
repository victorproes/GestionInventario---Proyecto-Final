<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductSold
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $productId;
    public $quantity;
    public $isCancel;

    public function __construct($productId, $quantity, $isCancel = false)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->isCancel = $isCancel;
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
