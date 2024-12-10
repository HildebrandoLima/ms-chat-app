<?php

namespace App\Http\Controllers;

use App\Domain\Services\Message\Interfaces\ICreateMessageService;
use App\Http\Requests\Message\CreateMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private ICreateMessageService $createMessageService;

    public function __construct(ICreateMessageService $createMessageService)
    {
        $this->createMessageService = $createMessageService;
    }

    public function index(Request $request)
    {
        $messages = Message::where('from', 1)->where('to', $request->to)->get();
        return response()->json($messages);
    }

    public function store(CreateMessageRequest $request)
    {
        $success = $this->createMessageService->create($request);

        if (is_bool($success)) {
            if (!$success) {
                return Controller::error('Erro: Operação falhou.');
            }
            return Controller::post($success);

        } else {
            if ($success->isEmpty()) {
                return Controller::error('Erro: O data está vazia.');
            }
            return Controller::post($success);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $message = Message::findOrFail($id);
        $message->text = $validated['text'];
        $message->save();
        return response()->json($message);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
