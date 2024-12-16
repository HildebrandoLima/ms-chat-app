<?php

namespace Tests\Unit\Services\Message;

use App\Data\Repositories\Message\Interfaces\IUpdateMessageRepository;
use App\Domain\Services\Message\Concretes\UpdateMessageService;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateMessageServiceTest extends TestCase
{
    private UpdateMessageRequest $request;
    private IUpdateMessageRepository $updateUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'id' => rand(0, 100),
            'text' => Str::random(10),
        ];
    }

    public function test_success_edit_message_service(): void
    {
        // Arrange
        $this->request = new UpdateMessageRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['text'] = $this->data['text'];

        $messageDto = [
            'id' => rand(0, 100),
            'from' => rand(0, 100),
            'text' => Str::random(10),
            'to' => $this->request['to'],
            'status' => 'default',
        ];

        $this->updateUserRepository = $this->mock(IUpdateMessageRepository::class,
            function (MockInterface $mock) use ($messageDto) {
                $mock->shouldReceive('updateById')
                     ->with($this->request)
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
        $updateMessageService = new UpdateMessageService($this->updateUserRepository);
        $result = $updateMessageService->updateById($this->request);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($this->request['text'], $this->data['text']);

        $message = $result->first();
        $this->assertEquals($messageDto['id'], $message->id);
        $this->assertEquals($messageDto['from'], $message->from);
        $this->assertEquals($messageDto['text'], $message->text);
        $this->assertEquals($messageDto['to'], $message->to);
        $this->assertEquals($messageDto['status'], $message->status);
    }
}
