<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IListMessageByIdRepository;
use App\Domain\Dtos\MessageDto;
use App\Domain\Services\Message\Interfaces\IListMessageByIdService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use Illuminate\Support\Collection;

class ListMessageByIdService implements IListMessageByIdService
{
    use ListPaginationMapper;

    private int $id = 0;
    private Collection $message;
    private Collection $messageDto;
    private IListMessageByIdRepository $listMessageByIdRepository;

    public function __construct(IListMessageByIdRepository $listMessageByIdRepository)
    {
        $this->listMessageByIdRepository = $listMessageByIdRepository;
    }

    public function listFindById(int $id): Collection
    {
        $this->id = $id;
        $this->collectionList();
        $this->messageDto();
        return $this->messageDto;
    }

    private function collectionList(): void
    {
        $this->message = $this->listMessageByIdRepository->listFindById($this->id);
    }

    private function messageDto(): void
    {
        $this->messageDto =  $this->mapToDtoList($this->message, MessageDto::class);
    }
}
