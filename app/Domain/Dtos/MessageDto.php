<?php

namespace App\Domain\Dtos;

use App\Domain\Traits\Dtos\DefaultFields;

class MessageDto
{
    use DefaultFields;

    public int $from = 0;
    public string $text = "";
    public string $status = "";
    public int $to = 0;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
