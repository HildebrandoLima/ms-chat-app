<?php

namespace App\Domain\Services\User\Interfaces;

interface IDeleteUserByIdService
{
    public function deleteById(int $id): bool;
}
