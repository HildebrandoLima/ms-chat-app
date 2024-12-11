<?php

namespace App\Domain\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domain\Services\User\Interfaces\IUpdateUserService;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\User\UpdateUserRequest;

class UpdateUserService implements IUpdateUserService
{
    use RequestConfigurator;

    private bool $user;
    private IUpdateUserRepository $updateUserRepository;

    public function __construct(IUpdateUserRepository $updateUserRepository)
    {
        $this->updateUserRepository = $updateUserRepository;
    }

    public function updateById(UpdateUserRequest $request): bool
    {
        $this->setRequest($request);
        $this->updated();
        return $this->user;
    }

    private function updated(): void
    {
        $this->user = $this->updateUserRepository->updateById($this->request);
    }
}
