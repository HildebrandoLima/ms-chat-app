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
        return Message::where(function ($query) use ($request) {
            $query->where('from', $request->from)
                  ->where('to', $request->to)
                  ->orWhere(function ($subQuery) use ($request) {
                    $subQuery->where('from', $request->to)
                             ->where('to', $request->from);
                });
        })
        ->orderBy('created_at', 'asc')
        ->get();
    }
}
