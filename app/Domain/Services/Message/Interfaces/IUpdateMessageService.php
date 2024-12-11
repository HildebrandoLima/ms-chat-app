<?php

namespace App\Domain\Services\Message\Interfaces;

use App\Http\Requests\Message\UpdateMessageRequest;

interface IUpdateMessageService
{
    public function updateById(UpdateMessageRequest $request): bool;
}
