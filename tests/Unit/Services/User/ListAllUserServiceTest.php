<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Domain\Services\User\Concretes\ListAllUserService;
use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllUserServiceTest extends TestCase
{
    use GenerateEmail;

    private UserRequest $request;
    private IListAllUserRepository $listAllUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'name' => Str::random(10),
        ];
    }

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $this->request = new UserRequest();

        $userDto = [
            'id' => rand(0, 100),
            'name' => Str::random(10),
            'email' => $this->generateEmail(),
            'friends' => [],
        ];

        $this->listAllUserRepository = $this->mock(IListAllUserRepository::class,
            function (MockInterface $mock) use ($userDto) {
                $mock->shouldReceive('listAll')
                     ->with($this->request)
                     ->andReturn(collect([new User($userDto)]));
        });

        // Act
        $listAllUserService = new ListAllUserService($this->listAllUserRepository);
        $result = $listAllUserService->listAll($this->request);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);

        $user = $result->first();
        $this->assertEquals($userDto['id'], $user->id);
        $this->assertEquals($userDto['name'], $user->name);
        $this->assertEquals($userDto['email'], $user->email);
    }

    public function test_success_list_user_all_search_name_service(): void
    {
        // Arrange
        $this->request = new UserRequest();
        $this->request['name'] = $this->data['name'];

        $userDto = [
            'id' => rand(0, 100),
            'name' => $this->request['name'],
            'email' => $this->generateEmail(),
            'friends' => [],
        ];

        $this->listAllUserRepository = $this->mock(IListAllUserRepository::class,
            function (MockInterface $mock) use ($userDto) {
                $mock->shouldReceive('listAll')
                     ->with($this->request)
                     ->andReturn(collect([new User($userDto)]));
        });

        // Act
        $listAllUserService = new ListAllUserService($this->listAllUserRepository);
        $result = $listAllUserService->listAll($this->request);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($this->request['name'], $this->data['name']);

        $user = $result->first();
        $this->assertEquals($userDto['id'], $user->id);
        $this->assertEquals($userDto['name'], $user->name);
        $this->assertEquals($userDto['email'], $user->email);
    }
}
