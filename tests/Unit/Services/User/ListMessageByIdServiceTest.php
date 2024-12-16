<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\IListUserByIdRepository;
use App\Domain\Services\User\Concretes\ListUserByIdService;
use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListMessageByIdServiceTest extends TestCase
{
    use GenerateEmail;

    private UserRequest $request;
    private IListUserByIdRepository $listUserByIdRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'id' =>  rand(0, 100),
        ];
    }

    public function test_success_list_user_find_by_id_service(): void
    {
        // Arrange
        $this->request = new UserRequest();
        $this->request['id'] = $this->data['id'];

        $userDto = [
            'id' => $this->request['id'],
            'name' => Str::random(10),
            'email' => $this->generateEmail(),
            'friends' => [],
        ];

        $this->listUserByIdRepository = $this->mock(IListUserByIdRepository::class,
            function (MockInterface $mock) use ($userDto) {
                $mock->shouldReceive('listFindById')
                     ->with($this->request['id'])
                     ->andReturn(collect([new User($userDto)]));
        });

        // Act
        $listUserByIdService = new ListUserByIdService($this->listUserByIdRepository);
        $result = $listUserByIdService->listFindById($this->request['id']);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);

        $user = $result->first();
        $this->assertEquals($userDto['id'], $user->id);
        $this->assertEquals($userDto['name'], $user->name);
        $this->assertEquals($userDto['email'], $user->email);
    }
}
