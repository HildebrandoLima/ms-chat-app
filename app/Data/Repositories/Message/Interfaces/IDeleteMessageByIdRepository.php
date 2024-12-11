<?php

namespace App\Data\Repositories\Message\Interfaces;

use Illuminate\Support\Collection;

interface IDeleteMessageByIdRepository
{
    public function deleteById(int $id): Collection;
}
