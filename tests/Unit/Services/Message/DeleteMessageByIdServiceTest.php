<?php

namespace Tests\Unit\Services\Message;

use App\Data\Repositories\Message\Concretes\DeleteMessageByIdRepository;
use App\Domain\Services\Message\Concretes\DeleteMessageByIdService;
use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class DeleteMessageByIdServiceTest extends TestCase
{
    private DeleteMessageByIdRepository $deleteMessageByIdRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_message_delete_service(): void
    {
        // Arrange
        $data = [
            'id' => rand(0, 100),
            'text' => Str::random(10)
        ];

        $messageDto = [
            'id' => $data['id'],
            'from' => $data['id'],
            'text' => $data['text'],
            'to' => $data['id'],
            'status' => 'default',
        ];

        $this->deleteMessageByIdRepository = $this->mock(DeleteMessageByIdRepository::class,
            function (MockInterface $mock) use ($messageDto) {
                $mock->shouldReceive('deleteById')
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
        $deleteMessageByIdService = new DeleteMessageByIdService($this->deleteMessageByIdRepository);
        $result = $deleteMessageByIdService->deleteById($data['id']);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);

        $message = $result->first();
        $this->assertEquals($messageDto['id'], $message->id);
        $this->assertEquals($messageDto['from'], $message->from);
        $this->assertEquals($messageDto['text'], $message->text);
        $this->assertEquals($messageDto['to'], $message->to);
        $this->assertEquals($messageDto['status'], $message->status);
    }
}
