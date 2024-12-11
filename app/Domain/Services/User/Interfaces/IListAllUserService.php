<?php

namespace App\Domain\Services\User\Interfaces;

use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Collection;

interface IListAllUserService
{
    public function listAll(UserRequest $request): Collection;
}
