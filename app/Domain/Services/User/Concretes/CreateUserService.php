<?php

namespace App\Domain\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domain\Services\User\Interfaces\ICreateUserService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\User\CreateUserRequest;

class CreateUserService implements ICreateUserService
{
    use RequestConfigurator;

    private bool $user;
    private ICreateUserRepository $createUserRepository;

    public function __construct(ICreateUserRepository $createUserRepository)
    {
        $this->createUserRepository = $createUserRepository;
    }

    public function create(CreateUserRequest $request): bool
    {
        $this->setRequest($request);
        $this->created();
        return $this->user;
    }

    private function created(): void
    {
        $this->user = $this->createUserRepository->create($this->request);
    }
}
