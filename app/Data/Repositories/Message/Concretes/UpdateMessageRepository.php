<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\IUpdateMessageRepository;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Exception;

class UpdateMessageRepository implements IUpdateMessageRepository
{
    public function updateById(UpdateMessageRequest $request): Collection
    {
        try {
            DB::beginTransaction();
            Message::where('id', $request->id)
            ->update([
                'text' => $request->text,
            ]);
            DB::commit();
            $message = Message::where('id', $request->id)->first();
            return collect([$message]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar edição da mensagem:', ['exception' => $e->getMessage()]);
			return collect([]);
        }
    }
}
