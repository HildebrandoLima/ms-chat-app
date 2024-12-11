<?php

namespace App\Data\Repositories\Message\Interfaces;

use App\Http\Requests\Message\UpdateMessageRequest;
use Illuminate\Support\Collection;

interface IUpdateMessageRepository
{
    public function updateById(UpdateMessageRequest $request): Collection;
}
