<?php

namespace Tests\Unit\Repositories\User;

use App\Data\Repositories\User\Concretes\DeleteUserByIdRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DeleteUserByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private DeleteUserByIdRepository $deleteUserByIdRepository;

    public function test_success_delete_user_repository(): void
    {
        // Arrange
        $id = rand(0, 100);

        // Act
        $this->deleteUserByIdRepository = new DeleteUserByIdRepository();
        $result = $this->deleteUserByIdRepository->deleteById($id);

        // Assert
        $this->assertTrue($result);
        $this->assertIsBool($result);
    }
}
