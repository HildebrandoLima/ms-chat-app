<?php

namespace Tests\Feature\Message;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllMessageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group message
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $data = [
            'to' => User::factory()->createOne()->id
        ];

        // Act
        $response = $this->getJson(route('message.index', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}