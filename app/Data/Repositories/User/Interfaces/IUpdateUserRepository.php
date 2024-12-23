<?php

namespace App\Data\Repositories\User\Interfaces;

use App\Http\Requests\User\UpdateUserRequest;

interface IUpdateUserRepository
{
    public function updateById(UpdateUserRequest $request): bool;
}
