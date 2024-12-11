<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IDeleteMessageByIdRepository;
use App\Domain\Dtos\MessageDto;
use App\Domain\Services\Message\Interfaces\IDeleteMessageByIdService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use Illuminate\Support\Collection;

class DeleteMessageByIdService implements IDeleteMessageByIdService
{
    use ListPaginationMapper;

    private int $id = 0;
    private Collection $message;
    private Collection $messageDto;
    private IDeleteMessageByIdRepository $deleteMessageByIdRepository;

    public function __construct(IDeleteMessageByIdRepository $deleteMessageByIdRepository)
    {
        $this->deleteMessageByIdRepository = $deleteMessageByIdRepository;
    }

    public function deleteById(int $id): Collection
    {
        return $this->deleteMessageByIdRepository->deleteById($id);
    }

    private function updated(): void
    {
        $this->message = $this->deleteMessageByIdRepository->deleteById($this->id);
    }

    private function messageDto(): void
    {
        $this->messageDto = $this->mapToDtoList($this->message, MessageDto::class);
    }
}
