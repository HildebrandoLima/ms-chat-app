<?php

namespace App\Data\Repositories\Message\Concretes;

use App\Data\Repositories\Message\Interfaces\ICreateMessageRepository;
use App\Http\Requests\Message\CreateMessageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Exception;

class CreateMessageRepository implements ICreateMessageRepository
{
    public function create(CreateMessageRequest $request): Collection
    {
        try {
            DB::beginTransaction();
            $message = Message::create([
                'from' => $request->from,
                'text' => $request->text,
                'to' => $request->to,
            ]);
            DB::commit();
            return collect([$message]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao realizar cadastro de message:', ['exception' => $e->getMessage()]);
			return collect([]);
        }
    }
}
