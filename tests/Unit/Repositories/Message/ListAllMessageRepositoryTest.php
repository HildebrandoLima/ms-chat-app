<?php

namespace Tests\Unit\Repositories\Message;

use App\Data\Repositories\Message\Concretes\ListAllMessageRepository;
use App\Data\Repositories\Message\Interfaces\IListAllMessageRepository;
use App\Http\Requests\Message\MessageRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ListAllMessageRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IListAllMessageRepository $listAllMessageRepository;

    public function test_success_list_message_all_repository(): void
    {
        // Arrange
        $request = new MessageRequest();
        $request['to'] = 1;

        // Act
        $this->listAllMessageRepository = new ListAllMessageRepository();
        $result = $this->listAllMessageRepository->listAll($request);

        // Assert
        $this->assertInstanceOf(Collection::class, $result);
    }
}
