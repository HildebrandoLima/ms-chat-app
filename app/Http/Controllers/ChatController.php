<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('from', 1)->where('to', $request->to)->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|integer',
            'text' => 'required|string',
            'to' => 'required|integer',
        ]);

        $message = Message::create([
            'from' => 1,
            'text' => $validated['text'],
            'to' => 2,
        ]);

        // Dispara o evento de broadcast
        broadcast(new MessageSent($validated['from'], $validated['text'], $validated['to']));

        return response()->json(['message' => 'Message sent', 'data' => $message, 'status' => 201]);    // Retorna a mensagem criada
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
