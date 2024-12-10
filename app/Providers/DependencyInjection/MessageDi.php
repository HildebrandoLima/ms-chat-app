<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Message\Concretes\CreateMessageRepository;
use App\Data\Repositories\Message\Interfaces\ICreateMessageRepository;

use App\Domain\Services\Message\Concretes\CreateMessageService;
use App\Domain\Services\Message\Interfaces\ICreateMessageService;

class MessageDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateMessageService::class, CreateMessageService::class],
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateMessageRepository::class, CreateMessageRepository::class],
        ];
    }
}