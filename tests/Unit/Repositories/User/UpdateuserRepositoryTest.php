<?php

namespace Tests\Unit\Repositories\User;

use App\Data\Repositories\User\Concretes\UpdateUserRepository;
use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateUserRepositoryTest extends TestCase
{
    use DatabaseTransactions, GenerateEmail;

    private UpdateUserRepository $updateUserRepository;

    public function test_success_update_user_repository(): void
    {
        // Arrange
        $request = new UpdateUserRequest();
        $request['id'] = rand(0, 100);
        $request['name'] = Str::random(10);
        $request['email'] = $this->generateEmail();

        // Act
        $this->updateUserRepository = new UpdateUserRepository();
        $result = $this->updateUserRepository->updateById($request);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
