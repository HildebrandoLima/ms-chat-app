<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $from;
    public string $text;
    public int $to;

    public function __construct(int $from, string $text, int $to)
    {
        $this->from = $from;
        $this->text = $text;
        $this->to = $to;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->from),
            new Channel('chat.' . $this->to),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message';
    }

    public function broadcastWith(): array
    {
        return [
            'from' => $this->from,
            'text' => $this->text,
            'to' => $this->to,
        ];
    }
}
