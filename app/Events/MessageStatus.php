<?php

namespace App\Events;
use App\User;;
use App\User_Activity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $active;
	public $sender_user;
     /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($active,$sender_user)
    {
        $this->active = $active;
		$this->sender_user = $sender_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('pizza-tracker.'.$this->order->id);
     return ['message_status'.$this->active['reciever_id']];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
  
}
