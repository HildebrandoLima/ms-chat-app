<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IUpdateMessageRepository;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateMessageRepository implements IUpdateMessageRepository
{
    public function updateById(UpdateMessageRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Message::where('id', $request->id)
            ->update([
                'text' => $request->text,
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar edição da mensagem:', ['exception' => $e->getMessage()]);
			return false;
        }
    }
}
