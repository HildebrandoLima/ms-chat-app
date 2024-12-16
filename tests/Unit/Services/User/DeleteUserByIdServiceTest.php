<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Concretes\DeleteUserByIdRepository;
use App\Domain\Services\User\Concretes\DeleteUserByIdService;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteUserByIdServiceTest extends TestCase
{
    private DeleteUserByIdRepository $deleteUserByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_user_delete_service(): void
    {
        // Arrange
        $id = rand(0, 100);

        $this->deleteUserByIdRepository = $this->mock(DeleteUserByIdRepository::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('deleteById')
                     ->with($id)
                     ->andReturn(true);
        });

        // Act
        $deleteUserByIdService = new DeleteUserByIdService($this->deleteUserByIdRepository);
        $result = $deleteUserByIdService->deleteById($id);

        // Assert
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }
}
