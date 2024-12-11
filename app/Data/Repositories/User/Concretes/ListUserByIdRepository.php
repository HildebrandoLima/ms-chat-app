<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListUserByIdRepository;
use App\Models\User;
use Illuminate\Support\Collection;

class ListUserByIdRepository implements IListUserByIdRepository
{
    public function listFindById(int $id): Collection
    {
        return User::with(['friends'])->where('id', $id)->get();
    }
}
