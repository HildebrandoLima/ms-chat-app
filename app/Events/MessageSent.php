<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent
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

    public function broadcastWith()
    {
        return [
            'from' => $this->from,
            'text' => $this->text,
        ];
    }
}
