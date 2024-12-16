<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domain\Services\User\Concretes\CreateUserService;
use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Domain\Traits\GenerateData\GeneratePassword;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    use GenerateEmail, GeneratePassword;

    private CreateUserRequest $request;
    private ICreateUserRepository $createUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'name' => Str::random(10),
            'email' => $this->generateEmail(),
            'password' => $this->generatePassword(),
        ];
    }

    public function test_success_create_user_service(): void
    {
        // Arrange
        $this->request = new CreateUserRequest();
        $this->request['name'] = $this->data['name'];
        $this->request['email'] = $this->data['email'];
        $this->request['password'] = $this->data['password'];

        $this->createUserRepository = $this->mock(ICreateUserRepository::class,
            function (MockInterface $mock)  {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $createUserService = new CreateUserService($this->createUserRepository);
        $result = $createUserService->create($this->request);

        // Assert
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }
}
