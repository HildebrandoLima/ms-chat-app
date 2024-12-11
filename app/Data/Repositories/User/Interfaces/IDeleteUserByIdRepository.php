<?php

namespace App\Data\Repositories\User\Interfaces;

interface IDeleteUserByIdRepository
{
    public function deleteById(int $id): bool;
}
