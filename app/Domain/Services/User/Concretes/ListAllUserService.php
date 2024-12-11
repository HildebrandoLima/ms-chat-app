<?php

namespace App\Domain\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Domain\Dtos\UserDto;
use App\Domain\Services\User\Interfaces\IListAllUserService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use App\Domain\Traits\RequestConfigurator;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Collection;

class ListAllUserService implements IListAllUserService
{
    use RequestConfigurator, ListPaginationMapper;

    private Collection $user;
    private Collection $userDto;
    private IListAllUserRepository $listAllUserRepository;

    public function __construct(IListAllUserRepository $listAllUserRepository)
    {
        $this->listAllUserRepository = $listAllUserRepository;
    }

    public function listAll(UserRequest $request): Collection
    {
        $this->setRequest($request);
        $this->collectionList();
        $this->userDto();
        return $this->userDto;
    }

    private function collectionList(): void
    {
        $this->user = $this->listAllUserRepository->listAll($this->request);
    }

    private function userDto(): void
    {
        $this->userDto =  $this->mapToDtoList($this->user, UserDto::class);
    }
}
