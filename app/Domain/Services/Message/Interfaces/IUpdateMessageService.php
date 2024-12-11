<?php

namespace App\Domain\Services\Message\Interfaces;

use App\Http\Requests\Message\UpdateMessageRequest;
use Illuminate\Support\Collection;

interface IUpdateMessageService
{
    public function updateById(UpdateMessageRequest $request): Collection;
}
