<?php

namespace App\Domain\Services\Message\Interfaces;

use Illuminate\Support\Collection;

interface IDeleteMessageByIdService
{
    public function deleteById(int $id): Collection;
}
