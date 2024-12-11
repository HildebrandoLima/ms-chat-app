<?php

namespace App\Data\Repositories\Message\Interfaces;

use App\Http\Requests\Message\MessageRequest;
use Illuminate\Support\Collection;

interface IListAllMessageRepository
{
    public function listAll(MessageRequest $request): Collection;
}
