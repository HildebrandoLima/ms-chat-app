<?php

namespace App\Domain\Services\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IUpdateMessageRepository;
use App\Domain\Services\Message\Interfaces\IUpdateMessageService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\Message\UpdateMessageRequest;

class UpdateMessageService implements IUpdateMessageService
{
    use RequestConfigurator;

    private IUpdateMessageRepository $updateMessageRepository;

    public function __construct(IUpdateMessageRepository $updateMessageRepository)
    {
        $this->updateMessageRepository = $updateMessageRepository;
    }

    public function updateById(UpdateMessageRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateMessageRepository->updateById($this->request);
    }
}
