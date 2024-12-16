<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserByIdTest extends TestCase
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
    public function it_endpoint_get_list_find_by_id_base_response_200(): void
    {
        // Arrange
        $data = [
            'id' => $this->user->id,
        ];

        // Act
        $response = $this->getJson(route('user.show', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
