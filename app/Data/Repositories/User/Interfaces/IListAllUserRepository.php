<?php

namespace App\Data\Repositories\User\Interfaces;

use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Collection;

interface IListAllUserRepository
{
    public function listAll(UserRequest $request): Collection;
}
