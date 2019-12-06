<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ImportEmailMarketingNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $list_uid;
    public $name;
    public $email;
    public $status;
    public $count = [];
    public $percentage;
    public $is_done;
    public $check;
    public $validate;
    public $import;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->list_uid = $data['list_uid'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->status = $data['status'];
        $this->count = $data['count'];
        $this->percentage = number_format((float)$data['percentage'], 2, '.', '');
        $this->is_done = $data['is_done'];
        $this->check = $data['check'];
        $this->validate = $data['validate'];
        $this->import = $data['import'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(){
        // return new PrivateChannel('channel-name');
        // return ['my-channel'];
        return 'my-channel';
    }

    public function broadcastAs(){
        return 'my-event-' . $this->list_uid;
    }
}
