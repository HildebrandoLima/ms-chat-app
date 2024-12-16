<?php

namespace Tests;

use App\Domain\Traits\GenerateData\GeneratePassword;
use App\Support\Utils\Paginator\Concrete\PaginatedList;
use App\Support\Utils\Paginator\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;
use Mockery\MockInterface;
use DateTime;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, GeneratePassword;

    private IPagination $pagination;
    private ISearch $search;

    protected function httpStatusCode(TestResponse $response): int
    {
        return $response->baseResponse->original['status'];
    }

    protected function baseResponse(TestResponse $response): string
    {
        return json_encode($response->baseResponse->original);
    }

    protected function countPaginateList(TestResponse $response): int
    {
        return count($response->baseResponse->original['data']['list']);
    }

    protected function paginatedList(): Collection
    {
        return PaginatedList::createFromPagination(new LengthAwarePaginator(collect([]), 0, 1, 10));
    }

    protected function lengthAwarePaginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator(collect([]), 0, 1, 10);
    }

    protected function caseDate(string $dateRequest): bool
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateRequest);
        if ($date && $date->format('Y-m-d H:i:s') == $dateRequest) {
            return true;
        } else {
            return false;
        }
    }

    protected function mask(int $value, string $format): string
    {
        $mask = '';
        $position_value = 0;
        for ($i = 0; $i <= strlen($format) - 1; $i++) {

            if ($format[$i] == '#') {

                if (isset($value[$position_value])) {
                    $mask .= $value[$position_value++];
                }

            } else {
                $mask .= $format[$i];
            }
        }
        return $mask;
    }

    protected function setMockPagination(bool $hasPagination): IPagination
    {
        $this->pagination = $this->mock(IPagination::class,
            function (MockInterface $mock) use ($hasPagination) {
                $mock->shouldReceive('setPage')->withAnyArgs();
                $mock->shouldReceive('setPerPage')->withAnyArgs();
                $mock->shouldReceive('hasPagination')->andReturn($hasPagination);
        });
        return $this->pagination;
    }

    protected function setMockSearch(string $searchRandom): ISearch
    {
        $this->search = $this->mock(ISearch::class,
            function (MockInterface $mock) use ($searchRandom) {
                $mock->shouldReceive('setSearch')->with($searchRandom);
                $mock->shouldReceive('getSearch')->andReturn($searchRandom);
        });
        return $this->search;
    }
}
