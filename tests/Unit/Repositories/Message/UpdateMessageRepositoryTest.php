<?php

namespace Tests\Unit\Repositories\Message;

use App\Data\Repositories\Message\Concretes\UpdateMessageRepository;
use App\Http\Requests\Message\UpdateMessageRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateMessageRepositoryTest extends TestCase
{
    private UpdateMessageRepository $updateUserRepository;

    public function test_success_update_message_repository(): void
    {
        // Arrange
        $request = new UpdateMessageRequest();
        $request['id'] = 1;
        $request['text'] = Str::random(10);

        // Act
        $this->updateUserRepository = new UpdateMessageRepository();
        $result = $this->updateUserRepository->updateById($request);
        $message = $result->first();

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals($request['id'], $message->id);
        $this->assertEquals($request['text'], $message->text);
    }
}
