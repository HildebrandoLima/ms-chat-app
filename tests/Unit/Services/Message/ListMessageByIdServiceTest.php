<?php

namespace Tests\Unit\Services\Message;

use App\Data\Repositories\Message\Concretes\ListMessageByIdRepository;
use App\Domain\Services\Message\Concretes\ListMessageByIdService;
use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListMessageByIdServiceTest extends TestCase
{
    private ListMessageByIdRepository $listMessageByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_message_find_by_id_service(): void
    {
        // Arrange
        $id = rand(0, 100);

        $messageDto = [
            'id' => $id,
            'from' => $id,
            'text' => Str::random(10),
            'to' => $id,
            'status' => 'default',
        ];

        $this->listMessageByIdRepository = $this->mock(ListMessageByIdRepository::class,
            function (MockInterface $mock) use ($messageDto) {
                $mock->shouldReceive('listFindById')
                     ->with($messageDto['id'])
                     ->andReturn(collect([
                        new Message([
                            'id' => $messageDto['id'],
                            'from' => $messageDto['from'],
                            'text' => $messageDto['text'],
                            'to' => $messageDto['to'],
                            'status' => $messageDto['status'],
                        ])
                     ]));
        });

        // Act
        $listMessageByIdService = new ListMessageByIdService($this->listMessageByIdRepository);
        $result = $listMessageByIdService->listFindById($id);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($id, $messageDto['id']);

        $message = $result->first();
        $this->assertEquals($messageDto['id'], $message->id);
        $this->assertEquals($messageDto['from'], $message->from);
        $this->assertEquals($messageDto['text'], $message->text);
        $this->assertEquals($messageDto['to'], $message->to);
        $this->assertEquals($messageDto['status'], $message->status);
    }
}
