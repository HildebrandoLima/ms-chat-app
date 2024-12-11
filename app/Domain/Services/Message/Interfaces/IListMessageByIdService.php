<?php

namespace App\Domain\Services\Message\Interfaces;

use Illuminate\Support\Collection;

interface IListMessageByIdService
{
    public function listFindById(int $id): Collection;
}
