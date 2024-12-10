<?php

namespace App\Data\Repositories\Message\Interfaces;

use App\Http\Requests\Message\CreateMessageRequest;
use Illuminate\Support\Collection;

interface ICreateMessageRepository
{
    public function create(CreateMessageRequest $request): Collection;
}
