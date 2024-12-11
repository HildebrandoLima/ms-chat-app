<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IListAllMessageRepository;
use App\Http\Requests\Message\MessageRequest;
use App\Models\Message;
use Illuminate\Support\Collection;

class ListAllMessageRepository implements IListAllMessageRepository
{
    public function listAll(MessageRequest $request): Collection
    {
        return Message::where('from', 1)->where('to', $request->to)->get();
    }
}
