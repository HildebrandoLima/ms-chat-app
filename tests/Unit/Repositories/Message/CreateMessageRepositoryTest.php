<?php

namespace Tests\Unit\Repositories\Message;

use App\Data\Repositories\Message\Concretes\CreateMessageRepository;
use App\Http\Requests\Message\CreateMessageRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateMessageRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private CreateMessageRepository $createMessageRepository;

    public function test_success_create_message_repository(): void
    {
        // Arrange
        $request = new CreateMessageRequest();
        $request['from'] = 1;
        $request['text'] = Str::random(10);
        $request['to'] = 2;

        // Act
        $this->createMessageRepository = new CreateMessageRepository();
        $result = $this->createMessageRepository->create($request);
        $message = $result->first();

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($request['from'], $message->from);
        $this->assertEquals($request['text'], $message->text);
        $this->assertEquals($request['to'], $message->to);
    }
}
