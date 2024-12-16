<?php

namespace Tests\Feature\Message;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListMessageByIdTest extends TestCase
{
    private Message $message;

    protected function setUp(): void
    {
        parent::setUp();
        $this->message = Message::factory()->createOne();
    }

    /**
     * @test
     * @group client
     */
    public function it_endpoint_get_list_find_by_id_base_response_200(): void
    {
        // Arrange
        $data = [
            'id' => $this->message->id,
        ];

        // Act
        $response = $this->getJson(route('message.show', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}