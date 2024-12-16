<?php

namespace Tests\Feature\User;

use App\Domain\Traits\GenerateData\GenerateEmail;
use App\Domain\Traits\GenerateData\GeneratePassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use GenerateEmail, GeneratePassword;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $data = [
            'name' => Str::random(50),
            'email' => $this->generateEmail(),
            'password' => $this->generatePassword(),
        ];

        // Act
        $response = $this->postJson(route('user.store'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $data = [
            'name' => Str::random(50),
            'email' => $this->generateEmail(),
            'password' => null,
        ];

        // Act
        $response = $this->postJson(route('user.store'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_409(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $this->generatePassword(),
        ];

        // Act
        $response = $this->postJson(route('user.store'), $data);

        // Assert
        $response->assertStatus(409);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 409);
    }
}
