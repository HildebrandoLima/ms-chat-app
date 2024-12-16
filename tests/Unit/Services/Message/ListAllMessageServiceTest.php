<?php

namespace Tests\Unit\Services\Message;

use App\Data\Repositories\Message\Interfaces\IListAllMessageRepository;
use App\Domain\Services\Message\Concretes\ListAllMessageService;
use App\Http\Requests\Message\MessageRequest;
use App\Models\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllMessageServiceTest extends TestCase
{
    private MessageRequest $request;
    private IListAllMessageRepository $listAllMessageRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'to' => 2,
        ];
    }

    public function test_success_message_delete_service(): void
    {
        // Arrange
        $this->request = new MessageRequest();
        $this->request['to'] = $this->data['to'];

        $messageDto = [
            'id' => rand(0, 100),
            'from' => rand(0, 100),
            'text' => Str::random(10),
            'to' => $this->request['to'],
            'status' => 'default',
        ];

        $this->listAllMessageRepository = $this->mock(IListAllMessageRepository::class,
            function (MockInterface $mock) use ($messageDto) {
                $mock->shouldReceive('listAll')
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
        $listAllMessageService = new ListAllMessageService($this->listAllMessageRepository);
        $result = $listAllMessageService->listAll($this->request);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($this->request['to'], $this->data['to']);

        $message = $result->first();
        $this->assertEquals($messageDto['id'], $message->id);
        $this->assertEquals($messageDto['from'], $message->from);
        $this->assertEquals($messageDto['text'], $message->text);
        $this->assertEquals($messageDto['to'], $message->to);
        $this->assertEquals($messageDto['status'], $message->status);
    }
}
