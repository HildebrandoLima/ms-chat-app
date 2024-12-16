<?php

namespace Tests\Unit\Repositories\User;

use App\Data\Repositories\User\Concretes\CreateUserRepository;
use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Domain\Traits\GenerateData\GeneratePassword;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserRepositoryTest extends TestCase
{
    use DatabaseTransactions, GenerateEmail, GeneratePassword;

    private CreateUserRepository $createUserRepository;

    public function test_success_create_user_repository(): void
    {
        // Arrange
        $request = new CreateUserRequest();
        $request['name'] = Str::random(10);
        $request['email'] = $this->generateEmail();
        $request['password'] = $this->generatePassword();

        // Act
        $this->createUserRepository = new CreateUserRepository();
        $result = $this->createUserRepository->create($request);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
