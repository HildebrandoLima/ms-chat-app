<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IListMessageByIdRepository;
use App\Models\Message;
use Illuminate\Support\Collection;

class ListMessageByIdRepository implements IListMessageByIdRepository
{
    public function listFindById(int $id): Collection
    {
        return Message::where('id', $id)->get();
    }
}
