<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserByIdTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_delete_base_response_200(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        $data = [
            'id' => $user->id,
        ];

        // Act
        $response = $this->deleteJson(route('user.destroy', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
