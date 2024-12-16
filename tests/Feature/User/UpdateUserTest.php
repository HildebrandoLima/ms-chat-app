<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->createOne();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $data = [
            'id' => $this->user->id,
            'name' => Str::random(50),
            'email' => $this->user->email,
        ];

        // Act
        $response = $this->putJson(route('user.update'), $data);

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
            'id' => $this->user->id,
            'name' => null,
            'email' => $this->user->email,
        ];

        // Act
        $response = $this->putJson(route('user.update'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
