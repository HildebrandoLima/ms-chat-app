<?php

namespace App\Domain\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IDeleteUserByIdRepository;
use App\Domain\Services\User\Interfaces\IDeleteUserByIdService;

class DeleteUserByIdService implements IDeleteUserByIdService
{
    private int $id = 0;
    private bool $user;
    private IDeleteUserByIdRepository $deleteUserByIdRepository;

    public function __construct(IDeleteUserByIdRepository $deleteUserByIdRepository)
    {
        $this->deleteUserByIdRepository = $deleteUserByIdRepository;
    }

    public function deleteById(int $id): bool
    {
        $this->id = $id;
        $this->deleted();
        return $this->user;
    }

    private function deleted(): void
    {
        $this->user = $this->deleteUserByIdRepository->deleteById($this->id);
    }
}
