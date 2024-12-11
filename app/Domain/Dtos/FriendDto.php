<?php

namespace App\Domain\Dtos;

use App\Domain\Traits\Dtos\DefaultFields;

class FriendDto
{
    use DefaultFields;

    public string $name = "";

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
