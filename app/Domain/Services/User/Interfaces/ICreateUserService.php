<?php

namespace App\Domain\Services\User\Interfaces;

use App\Http\Requests\User\CreateUserRequest;

interface ICreateUserService
{
    public function create(CreateUserRequest $request): bool;
}
