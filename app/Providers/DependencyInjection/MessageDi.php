<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Message\Concretes\CreateMessageRepository;
use App\Data\Repositories\Message\Concretes\DeleteMessageByIdRepository;
use App\Data\Repositories\Message\Concretes\ListAllMessageRepository;
use App\Data\Repositories\Message\Concretes\ListMessageByIdRepository;
use App\Data\Repositories\Message\Concretes\UpdateMessageRepository;

use App\Data\Repositories\Message\Interfaces\ICreateMessageRepository;
use App\Data\Repositories\Message\Interfaces\IDeleteMessageByIdRepository;
use App\Data\Repositories\Message\Interfaces\IListAllMessageRepository;
use App\Data\Repositories\Message\Interfaces\IListMessageByIdRepository;
use App\Data\Repositories\Message\Interfaces\IUpdateMessageRepository;

use App\Domain\Services\Message\Concretes\ListAllMessageService;
use App\Domain\Services\Message\Concretes\CreateMessageService;
use App\Domain\Services\Message\Concretes\DeleteMessageByIdService;
use App\Domain\Services\Message\Concretes\ListMessageByIdService;
use App\Domain\Services\Message\Concretes\UpdateMessageService;

use App\Domain\Services\Message\Interfaces\ICreateMessageService;
use App\Domain\Services\Message\Interfaces\IDeleteMessageByIdService;
use App\Domain\Services\Message\Interfaces\IListAllMessageService;
use App\Domain\Services\Message\Interfaces\IListMessageByIdService;
use App\Domain\Services\Message\Interfaces\IUpdateMessageService;

class MessageDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateMessageService::class, CreateMessageService::class],
            [IDeleteMessageByIdService::class, DeleteMessageByIdService::class],
            [IListAllMessageService::class, ListAllMessageService::class],
            [IListMessageByIdService::class, ListMessageByIdService::class],
            [IUpdateMessageService::class, UpdateMessageService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateMessageRepository::class, CreateMessageRepository::class],
            [IDeleteMessageByIdRepository::class, DeleteMessageByIdRepository::class],
            [IListAllMessageRepository::class, ListAllMessageRepository::class],
            [IListMessageByIdRepository::class, ListMessageByIdRepository::class],
            [IUpdateMessageRepository::class, UpdateMessageRepository::class]
        ];
    }
}
