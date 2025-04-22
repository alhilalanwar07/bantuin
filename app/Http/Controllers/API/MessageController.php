<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('reference_number', $request->reference_number)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return MessageResource::collection($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number' => 'required|exists:service_requests,reference_number',
            'sender_id' => 'required|exists:users,id',
            'content' => 'required|string'
        ]);

        $message = Message::create($validated);
        return new MessageResource($message);
    }

    public function update(Request $request, Message $message)
    {
        $message->update(['is_read' => true]);
        return new MessageResource($message);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->noContent();
    }
}
