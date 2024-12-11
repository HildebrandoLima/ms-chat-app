<?php

namespace App\Data\Repositories\Message\Interfaces;

use App\Http\Requests\Message\UpdateMessageRequest;

interface IUpdateMessageRepository
{
    public function updateById(UpdateMessageRequest $request): bool;
}
