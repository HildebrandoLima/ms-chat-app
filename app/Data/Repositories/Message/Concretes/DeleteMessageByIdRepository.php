<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IDeleteMessageByIdRepository;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DeleteMessageByIdRepository implements IDeleteMessageByIdRepository
{
    public function deleteById(int $id): bool
    {
        try {
            DB::beginTransaction();
            Message::where('id', $id)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar remoção da mensagem:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
