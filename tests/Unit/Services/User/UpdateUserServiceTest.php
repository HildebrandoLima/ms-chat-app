<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domain\Services\User\Concretes\UpdateUserService;
use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateUserServiceTest extends TestCase
{    
    use GenerateEmail;

    private UpdateUserRequest $request;
    private IUpdateUserRepository $updateUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'id' => rand(0, 100),
            'name' => Str::random(10),
            'email' => $this->generateEmail(),
        ];
    }

    public function test_success_edit_User_service(): void
    {
        // Arrange
        $this->request = new UpdateUserRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['name'] = $this->data['name'];
        $this->request['email'] = $this->data['email'];

        $this->updateUserRepository = $this->mock(IUpdateUserRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('updateById')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateUserService = new UpdateUserService($this->updateUserRepository);
        $result = $updateUserService->updateById($this->request);

        // Assert
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }
}
