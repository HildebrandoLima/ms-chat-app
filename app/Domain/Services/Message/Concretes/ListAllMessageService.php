<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IListAllMessageRepository;
use App\Domain\Dtos\MessageDto;
use App\Domain\Services\Message\Interfaces\IListAllMessageService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Message\MessageRequest;
use Illuminate\Support\Collection;

class ListAllMessageService implements IListAllMessageService
{
    use RequestConfigurator, ListPaginationMapper;

    private Collection $message;
    private Collection $messageDto;
    private IListAllMessageRepository $listAllMessageRepository;

    public function __construct(IListAllMessageRepository $listAllMessageRepository)
    {
        $this->listAllMessageRepository = $listAllMessageRepository;
    }

    public function listAll(MessageRequest $request): Collection
    {
        $this->setRequest($request);
        $this->collectionList();
        $this->messageDto();
        return $this->messageDto;
    }

    private function collectionList(): void
    {
        $this->message = $this->listAllMessageRepository->listAll($this->request);
    }

    private function messageDto(): void
    {
        $this->messageDto =  $this->mapToDtoList($this->message, MessageDto::class);
    }
}
