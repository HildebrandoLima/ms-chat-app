<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllUserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $data = [];

        // Act
        $response = $this->getJson(route('user.index', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_base_seacrh_name_response_200(): void
    {
        // Arrange
        $data = [
            'name' => User::factory()->createOne()->name
        ];

        // Act
        $response = $this->getJson(route('user.index', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
