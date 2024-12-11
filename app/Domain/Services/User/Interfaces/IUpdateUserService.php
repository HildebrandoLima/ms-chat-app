<?php

namespace App\Domain\Services\User\Interfaces;

use App\Http\Requests\User\UpdateUserRequest;

interface IUpdateUserService
{
    public function updateById(UpdateUserRequest $request): bool;
}
