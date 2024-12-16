<?php

namespace Tests\Feature\Message;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteMessageByIdTest extends TestCase
{
    private Message $message;

    protected function setUp(): void
    {
        parent::setUp();
        $this->message = Message::factory()->createOne();
    }

    /**
     * @test
     * @group message
     */
    public function it_endpoint_delete_base_response_200(): void
    {
        // Arrange
        $data = [
            'id' => $this->message->id,
        ];

        // Act
        $response = $this->deleteJson(route('message.destroy', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
