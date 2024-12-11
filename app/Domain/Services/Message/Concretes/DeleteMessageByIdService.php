<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IDeleteMessageByIdRepository;
use App\Domain\Services\Message\Interfaces\IDeleteMessageByIdService;

class DeleteMessageByIdService implements IDeleteMessageByIdService
{
    private IDeleteMessageByIdRepository $deleteMessageByIdRepository;

    public function __construct(IDeleteMessageByIdRepository $deleteMessageByIdRepository)
    {
        $this->deleteMessageByIdRepository = $deleteMessageByIdRepository;
    }

    public function deleteById(int $id): bool
    {
        return $this->deleteMessageByIdRepository->deleteById($id);
    }
}
