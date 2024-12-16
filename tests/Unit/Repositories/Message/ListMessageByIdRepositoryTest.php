<?php

namespace Tests\Unit\Repositories\Message;

use App\Data\Repositories\Message\Concretes\ListMessageByIdRepository;
use App\Models\Message;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListMessageByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private ListMessageByIdRepository $listMessageByIdRepository;

    public function test_success_list_message_find_by_id_repository(): void
    {
        // Arrange
        $message = Message::factory()->createOne();

        // Act
        $this->listMessageByIdRepository = new ListMessageByIdRepository();
        $result = $this->listMessageByIdRepository->listFindById($message->id);

        // Assert
        $this->assertEquals($message->id, $result[0]->id);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
