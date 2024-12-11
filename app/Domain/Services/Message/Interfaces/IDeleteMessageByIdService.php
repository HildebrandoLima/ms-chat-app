<?php

namespace App\Domain\Services\Message\Interfaces;

interface IDeleteMessageByIdService
{
    public function deleteById(int $id): bool;
}
