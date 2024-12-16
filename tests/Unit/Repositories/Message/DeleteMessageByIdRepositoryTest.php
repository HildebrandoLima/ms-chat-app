<?php

namespace Tests\Unit\Repositories\Message;

use App\Data\Repositories\Message\Concretes\DeleteMessageByIdRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class DeleteMessageByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private DeleteMessageByIdRepository $deleteMessageByIdRepository;

    public function test_success_delete_message_repository(): void
    {
        // Arrange
        $id = rand(0, 100);

        // Act
        $this->deleteMessageByIdRepository = new DeleteMessageByIdRepository();
        $result = $this->deleteMessageByIdRepository->deleteById($id);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
    }
}
