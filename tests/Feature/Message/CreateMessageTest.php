<?php

namespace Tests\Feature\Message;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateMessageTest extends TestCase
{
    private Collection $users;

    protected function setUp(): void
    {
        parent::setUp();
        $this->users = User::factory()->createMany([[], []]);
    }

    /**
     * @test
     * @group message
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $data = [
            'from' => $this->users[0]->id,
            'text' => Str::random(10),
            'to' => $this->users[1]->id,
        ];

        // Act
        $response = $this->postJson(route('message.store'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group message
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'from' => $this->users[0]->id,
            'text' => Str::random(0),
            'to' => $this->users[1]->id,
        ];

        // Act
        $response = $this->postJson(route('message.store'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
