<?php

namespace App\Domain\Services\Message\Interfaces;

use App\Http\Requests\Message\CreateMessageRequest;
use Illuminate\Support\Collection;

interface ICreateMessageService
{
    public function create(CreateMessageRequest $request): Collection;
}
