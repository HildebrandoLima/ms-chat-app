<?php

namespace App\Domain\Traits\Dtos;

use App\Support\Utils\DateFormat\DefaultDate;

trait DefaultFields
{
    public int $id = 0;
    public ?string $createdAt = "";
    public ?string $updatedAt = "";

    protected function mapCommonFields(array $data): void
    {
        $this->createdAt = DefaultDate::dateFormat($data['created_at'] ?? '') ?? '';
        $this->updatedAt = DefaultDate::dateFormat($data['updated_at'] ?? '') ?? '';
    }
}
