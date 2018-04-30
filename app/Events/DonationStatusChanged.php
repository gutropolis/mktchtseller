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

class DonationStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $activityfeed;
	public $sender_user;
     /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($activityfeed,$sender_user)
    {
        $this->activityfeed = $activityfeed;
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
     return ['donation_status'.$this->activityfeed['reciever_id']];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
   /* public function broadcastWith()
    {
        $extra = [
            'status' => $this->donation_detail->status,
            'progress' => $this->donation_detail->progress,
        ];

        return array_merge($this->donation_detail->toArray(), $extra);
    }*/
}
