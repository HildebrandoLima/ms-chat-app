<?php

namespace Tests\Unit\Services\Message;

use App\Data\Repositories\Message\Interfaces\ICreateMessageRepository;
use App\Domain\Services\Message\Concretes\CreateMessageService;
use App\Http\Requests\Message\CreateMessageRequest;
use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateMessageServiceTest extends TestCase
{
    private CreateMessageRequest $request;
    private ICreateMessageRepository $createMessageRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'from' => 1,
            'text' => Str::random(10),
            'to' => 2,
        ];
    }

    public function test_success_create_message_service(): void
    {
        // Arrange
        $this->request = new CreateMessageRequest();
        $this->request['from'] = $this->data['from'];
        $this->request['text'] = $this->data['text'];
        $this->request['to'] = $this->data['to'];

        $messageDto = [
            'id' => rand(0, 100),
            'from' => $this->data['from'],
            'text' => $this->data['text'],
            'to' => $this->data['to'],
            'status' => 'default',
        ];

        $this->createMessageRepository = $this->mock(ICreateMessageRepository::class,
            function (MockInterface $mock) use ($messageDto) {
                $mock->shouldReceive('create')
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
        $createMessageService = new CreateMessageService($this->createMessageRepository);
        $result = $createMessageService->create($this->request);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($this->request['from'], $this->data['from']);
        $this->assertEquals($this->request['text'], $this->data['text']);
        $this->assertEquals($this->request['to'], $this->data['to']);

        $message = $result->first();
        $this->assertEquals($messageDto['id'], $message->id);
        $this->assertEquals($messageDto['from'], $message->from);
        $this->assertEquals($messageDto['text'], $message->text);
        $this->assertEquals($messageDto['to'], $message->to);
        $this->assertEquals($messageDto['status'], $message->status);
    }
}
