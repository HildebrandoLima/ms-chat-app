<?php

namespace App\Channels;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatChannel implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $from;
    public $text;
    public $to;

    public function __construct($from, $text, $to)
    {
        $this->from = $from;
        $this->text = $text;
        $this->to = $to;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->to);
    }

    public function broadcastAs()
    {
        return 'message';
    }
}
