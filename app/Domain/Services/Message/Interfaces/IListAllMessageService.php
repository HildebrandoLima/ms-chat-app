<?php

namespace App\Domain\Services\Message\Interfaces;

use App\Http\Requests\Message\MessageRequest;
use Illuminate\Support\Collection;

interface IListAllMessageService
{
    public function listAll(MessageRequest $request): Collection;
}
