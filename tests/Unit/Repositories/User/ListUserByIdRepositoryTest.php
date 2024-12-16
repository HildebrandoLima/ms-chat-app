<?php

namespace Tests\Unit\Repositories\User;

use App\Data\Repositories\User\Concretes\ListUserByIdRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListUserByIdRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private ListUserByIdRepository $listUserByIdRepository;

    public function test_success_list_user_find_by_id_repository(): void
    {
        // Arrange
        $user = User::factory()->createOne();

        // Act
        $this->listUserByIdRepository = new ListUserByIdRepository();
        $result = $this->listUserByIdRepository->listFindById($user->id);

        // Assert
        $this->assertEquals($user->id, $result[0]->id);
        $this->assertInstanceOf(Collection::class, $result);
    }
}
