<?php

namespace App\Data\Repositories\User\Interfaces;

use Illuminate\Support\Collection;

interface IListUserByIdRepository
{
    public function listFindById(int $id): Collection;
}
