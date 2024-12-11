<?php

namespace App\Domain\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IListUserByIdRepository;
use App\Domain\Dtos\UserDto;
use App\Domain\Services\User\Interfaces\IListUserByIdService;
use App\Domain\Traits\Dtos\ListPaginationMapper;
use Illuminate\Support\Collection;

class ListUserByIdService implements IListUserByIdService
{
    use ListPaginationMapper;

    private int $id = 0;
    private Collection $user;
    private Collection $userDto;
    private IListUserByIdRepository $listUserByIdRepository;

    public function __construct(IListUserByIdRepository $listUserByIdRepository)
    {
        $this->listUserByIdRepository = $listUserByIdRepository;
    }

    public function listFindById(int $id): Collection
    {
        $this->id = $id;
        $this->collectionList();
        $this->userDto();
        return $this->userDto;
    }

    private function collectionList(): void
    {
        $this->user = $this->listUserByIdRepository->listFindById($this->id);
    }

    private function userDto(): void
    {
        $this->userDto =  $this->mapToDtoList($this->user, UserDto::class);
    }
}
