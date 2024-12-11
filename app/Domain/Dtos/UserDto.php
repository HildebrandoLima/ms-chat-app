<?php

namespace App\Domain\Dtos;

use App\Domain\Traits\Dtos\DefaultFields;
use App\Domain\Traits\Dtos\Friend;

class UserDto
{
    use DefaultFields, Friend;

    public string $name = "";
    public string $email = "";
    public array $friends = [];

    public function customizeMapping(array $data): void
    {
        $this->friends = $this->friends($data['friends'] ?? []);
        $this->mapCommonFields($data);
    }
}
