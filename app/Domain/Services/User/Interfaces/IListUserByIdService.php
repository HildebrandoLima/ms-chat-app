<?php

namespace App\Domain\Services\User\Interfaces;

use Illuminate\Support\Collection;

interface IListUserByIdService
{
    public function listFindById(int $id): Collection;
}
