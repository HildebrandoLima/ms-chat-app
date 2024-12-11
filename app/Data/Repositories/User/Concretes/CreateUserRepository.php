<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserRepository implements ICreateUserRepository
{
    public function create(CreateUserRequest $request): bool
    {
        try {
            DB::beginTransaction();
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar cadastro de usuário:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
