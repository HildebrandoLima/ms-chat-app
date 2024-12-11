<?php

namespace App\Http\Controllers;

use App\Domain\Services\User\Interfaces\ICreateUserService;
use App\Domain\Services\User\Interfaces\IDeleteUserByIdService;
use App\Domain\Services\User\Interfaces\IListAllUserService;
use App\Domain\Services\User\Interfaces\IListUserByIdService;
use App\Domain\Services\User\Interfaces\IUpdateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private ICreateUserService     $createUserService;
    private IDeleteUserByIdService $deleteUserByIdService;
    private IListAllUserService    $listAllUserService;
    private IListUserByIdService   $listUserByIdService;
    private IUpdateUserService     $updateUserService;

    public function __construct
    (
        ICreateUserService     $createUserService,
        IDeleteUserByIdService $deleteUserByIdService,
        IListAllUserService    $listAllUserService,
        IListUserByIdService   $listUserByIdService,
        IUpdateUserService     $updateUserService
    )
    {
        $this->createUserService = $createUserService;
        $this->deleteUserByIdService = $deleteUserByIdService;
        $this->listAllUserService = $listAllUserService;
        $this->listUserByIdService = $listUserByIdService;
        $this->updateUserService = $updateUserService;
    }

    public function index(UserRequest $request): Response
    {
        $success = $this->listAllUserService->listAll($request);
        return Controller::get($success);
    }

    public function show(int $id): Response
    {
        $success = $this->listUserByIdService->listFindById($id);
        if ($success->isEmpty()) {
            return Controller::getIsNotEmpty();
        }
        return Controller::get($success);
    }

    public function store(CreateUserRequest $request): Response
    {
        $success = $this->createUserService->create($request);

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

    public function update(UpdateUserRequest $request): Response
    {
        $success = $this->updateUserService->updateById($request);

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
        $success = $this->deleteUserByIdService->deleteById($id);
        if (is_bool($success)) {
            if (!$success) {
                return $this->responseError('Error ao realizar operação.');
            }
            return Controller::delete($success);

        } else {
            if ($success->isEmpty()) {
                return $this->getIsNotEmpty();
            }
            return Controller::delete($success);
        }
    }

    private function responseError(string $message): Response
    {
        return Controller::error($message);
    }
}
