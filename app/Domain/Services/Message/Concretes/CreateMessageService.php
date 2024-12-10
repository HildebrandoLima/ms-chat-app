<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\ICreateMessageRepository;
use App\Domain\Dtos\MessageDto;
use App\Domain\Services\Message\Interfaces\ICreateMessageService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use App\Domain\Traits\RequestConfigurator;
use App\Events\MessageSent;
use App\Http\Requests\Message\CreateMessageRequest;
use Illuminate\Support\Collection;

class CreateMessageService implements ICreateMessageService
{
    use RequestConfigurator, ListPaginationMapper;

    private Collection $message;
    private Collection $messageDto;
    private ICreateMessageRepository $createMessageRepository;

    public function __construct(ICreateMessageRepository $createMessageRepository)
    {
        $this->createMessageRepository = $createMessageRepository;
    }

    public function create(CreateMessageRequest $request): Collection
    {
        $this->setRequest($request);
        $this->created();
        $this->triggerTheBroadcastEvent();
        $this->messageDto();
        return $this->messageDto;
    }

    private function created(): void
    {
        $this->message = $this->createMessageRepository->create($this->request);
    }

    private function triggerTheBroadcastEvent(): void
    {
        broadcast(new MessageSent($this->request->from, $this->request->text, $this->request->to));
    }

    private function messageDto(): void
    {
        $this->messageDto =  $this->mapToDtoList($this->message, MessageDto::class);
    }
}
