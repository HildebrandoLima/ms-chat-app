<?php

namespace Tests\Unit\Repositories\User;

use App\Data\Repositories\User\Concretes\ListAllUserRepository;
use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Http\Requests\User\UserRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class ListAllUserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private UserRequest $request;
    private IListAllUserRepository $listAllUserRepository;

    public function test_success_list_client_all_repository(): void
    {
        // Arrange
        $this->request = new UserRequest();

        // Act
        $this->listAllUserRepository = new ListAllUserRepository();
        $result = $this->listAllUserRepository->listAll($this->request);

        // Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function test_success_list_client_all_search_name_repository(): void
    {
        // Arrange
        $this->request = new UserRequest();
        $this->request['name'] = Str::random(10);

        // Act
        $this->listAllUserRepository = new ListAllUserRepository();
        $result = $this->listAllUserRepository->listAll($this->request);

        // Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
