<?php

namespace App\Data\Repositories\Message\Interfaces;

interface IDeleteMessageByIdRepository
{
    public function deleteById(int $id): bool;
}
