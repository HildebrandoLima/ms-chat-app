<?php

namespace Tests\Feature\Message;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteMessageByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group message
     */
    public function it_endpoint_delete_base_response_200(): void
    {
        // Arrange
        $message = Message::factory()->createOne()->toArray();
        $data = [
            'id' => $message['id'],
        ];

        // Act
        $response = $this->deleteJson(route('message.destroy', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
