<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IDeleteUserByIdRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DeleteUserByIdRepository implements IDeleteUserByIdRepository
{
    public function deleteById(int $id): bool
    {
        try {
            DB::beginTransaction();
            User::where('id', $id)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar remoção de usuário:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
