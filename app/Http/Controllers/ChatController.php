<?php

namespace App\Http\Controllers;

use App\Domain\Services\Message\Interfaces\ICreateMessageService;
use App\Domain\Services\Message\Interfaces\IDeleteMessageByIdService;
use App\Domain\Services\Message\Interfaces\IListAllMessageService;
use App\Domain\Services\Message\Interfaces\IListMessageByIdService;
use App\Domain\Services\Message\Interfaces\IUpdateMessageService;
use App\Http\Requests\Message\CreateMessageRequest;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
    private ICreateMessageService     $createMessageService;
    private IDeleteMessageByIdService $deleteMessageByIdService;
    private IListAllMessageService    $listAllMessageService;
    private IListMessageByIdService   $listMessageByIdService;
    private IUpdateMessageService     $updateMessageService;

    public function __construct
    (
        ICreateMessageService     $createMessageService,
        IDeleteMessageByIdService $deleteMessageByIdService,
        IListAllMessageService    $listAllMessageService,
        IListMessageByIdService   $listMessageByIdService,
        IUpdateMessageService     $updateMessageService
    )
    {
        $this->createMessageService = $createMessageService;
        $this->deleteMessageByIdService = $deleteMessageByIdService;
        $this->listAllMessageService = $listAllMessageService;
        $this->listMessageByIdService = $listMessageByIdService;
        $this->updateMessageService = $updateMessageService;
    }

    public function index(MessageRequest $request): Response
    {
        $success = $this->listAllMessageService->listAll($request);
        return Controller::get($success);
    }

    public function show(int $id): Response
    {
        $success = $this->listMessageByIdService->listFindById($id);
        if ($success->isEmpty()) {
            return Controller::getIsNotEmpty();
        }
        return Controller::get($success);
    }

    public function store(CreateMessageRequest $request): Response
    {
        $success = $this->createMessageService->create($request);

        if (is_bool($success)) {
            if (!$success) {
                return $this->responseError('Error ao realizar operação.');
            }
            return Controller::post($success);

        } else {
            if ($success->isEmpty()) {
                return $this->getIsNotEmpty();
            }
            return Controller::post($success);
        }
    }

    public function update(UpdateMessageRequest $request): Response
    {
        $success = $this->updateMessageService->updateById($request);

        if (is_bool($success)) {
            if (!$success) {
                return $this->responseError('Error ao alterar operação.');
            }
            return Controller::put($success);

        } else {
            if ($success->isEmpty()) {
                return $this->getIsNotEmpty();
            }
            return Controller::put($success);
        }
    }

    public function destroy(int $id): Response
    {
        $success = $this->deleteMessageByIdService->deleteById($id);
        if (!$success) {
            return $this->responseError('Error ao deletar mensagem.');
        }
        return Controller::delete($success);
    }

    private function responseError(string $message): Response
    {
        return Controller::error($message);
    }
}
