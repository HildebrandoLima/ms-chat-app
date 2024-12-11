<?php

namespace App\Data\Repositories\Message\Interfaces;

use Illuminate\Support\Collection;

interface IListMessageByIdRepository
{
    public function listFindById(int $id): Collection;
}
