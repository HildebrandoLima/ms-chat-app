<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IUpdateMessageRepository;
use App\Domain\Dtos\MessageDto;
use App\Domain\Services\Message\Interfaces\IUpdateMessageService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Message\UpdateMessageRequest;
use Illuminate\Support\Collection;

class UpdateMessageService implements IUpdateMessageService
{
    use RequestConfigurator, ListPaginationMapper;

    private Collection $message;
    private Collection $messageDto;
    private IUpdateMessageRepository $updateMessageRepository;

    public function __construct(IUpdateMessageRepository $updateMessageRepository)
    {
        $this->updateMessageRepository = $updateMessageRepository;
    }

    public function updateById(UpdateMessageRequest $request): Collection
    {
        $this->setRequest($request);
        $this->updated();
        $this->messageDto();
        return $this->messageDto;
    }

    private function updated(): void
    {
        $this->message = $this->updateMessageRepository->updateById($this->request);
    }

    private function messageDto(): void
    {
        $this->messageDto = $this->mapToDtoList($this->message, MessageDto::class);
    }
}
