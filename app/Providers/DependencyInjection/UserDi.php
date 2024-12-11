<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\User\Concretes\CreateUserRepository;
use App\Data\Repositories\User\Concretes\DeleteUserByIdRepository;
use App\Data\Repositories\User\Concretes\ListAllUserRepository;
use App\Data\Repositories\User\Concretes\ListUserByIdRepository;
use App\Data\Repositories\User\Concretes\UpdateUserRepository;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Data\Repositories\User\Interfaces\IDeleteUserByIdRepository;
use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Data\Repositories\User\Interfaces\IListUserByIdRepository;
use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;

use App\Domain\Services\User\Concretes\ListAllUserService;
use App\Domain\Services\User\Concretes\CreateUserService;
use App\Domain\Services\User\Concretes\DeleteUserByIdService;
use App\Domain\Services\User\Concretes\ListUserByIdService;
use App\Domain\Services\User\Concretes\UpdateUserService;

use App\Domain\Services\User\Interfaces\ICreateUserService;
use App\Domain\Services\User\Interfaces\IDeleteUserByIdService;
use App\Domain\Services\User\Interfaces\IListAllUserService;
use App\Domain\Services\User\Interfaces\IListUserByIdService;
use App\Domain\Services\User\Interfaces\IUpdateUserService;

class UserDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateUserService::class, CreateUserService::class],
            [IDeleteUserByIdService::class, DeleteUserByIdService::class],
            [IListAllUserService::class, ListAllUserService::class],
            [IListUserByIdService::class, ListUserByIdService::class],
            [IUpdateUserService::class, UpdateUserService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateUserRepository::class, CreateUserRepository::class],
            [IDeleteUserByIdRepository::class, DeleteUserByIdRepository::class],
            [IListAllUserRepository::class, ListAllUserRepository::class],
            [IListUserByIdRepository::class, ListUserByIdRepository::class],
            [IUpdateUserRepository::class, UpdateUserRepository::class]
        ];
    }
}
