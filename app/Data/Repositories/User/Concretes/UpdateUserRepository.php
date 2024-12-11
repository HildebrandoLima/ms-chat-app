<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateUserRepository implements IUpdateUserRepository
{
    public function updateById(UpdateUserRequest $request): bool
    {
        try {
            DB::beginTransaction();
            User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar edição de usuário:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
