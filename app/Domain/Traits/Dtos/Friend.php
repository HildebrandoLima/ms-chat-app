<?php

namespace App\Domain\Traits\Dtos;

use App\Domain\Dtos\FriendDto;

trait Friend
{
    use AutoMapper;

    public function friends(array $friends): array
    {
        foreach ($friends as $key => $value) {
            $friends[$key] = $this->mapTo($value, FriendDto::class);
        }
        return $friends;
    }
}
