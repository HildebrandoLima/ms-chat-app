<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IDeleteMessageByIdRepository;
use App\Models\Message;
use App\Support\Enums\StatusMessageEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Collection;

class DeleteMessageByIdRepository implements IDeleteMessageByIdRepository
{
    public function deleteById(int $id): Collection
    {
        try {
            DB::beginTransaction();
            //Message::where('id', $id)->delete();
            Message::where('id', $id)->update(['status' => StatusMessageEnum::MESSAGE_OFF]);
            DB::commit();
            $message = Message::where('id', $id)->first();
            return collect([$message]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar remoção da mensagem:', ['exception' => $e->getMessage()]);
			return collect([]);
        }
    }
}
