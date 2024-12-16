<?php

namespace Tests\Feature\Message;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateMessageTest extends TestCase
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
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $data = [
            'id' => $this->message->id,
            'text' => $this->message->text,
        ];

        // Act
        $response = $this->putJson(route('message.update'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group message
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $data = [
            'client_id' =>  $this->message->id,
            'text' => null,
        ];

        // Act
        $response = $this->putJson(route('message.update'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
