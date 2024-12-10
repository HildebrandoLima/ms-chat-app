<?php

namespace App\Support\Utils\Paginator\Interface;

interface IPagination
{
    public function getPage(): int;
    public function setPage(?int $page): void;
    public function getPerPage(): int;
    public function setPerPage(?int $perPage): void;
    public function hasPagination(): bool;
}
