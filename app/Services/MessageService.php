<?php

namespace App\Services;

use App\Models\Message;
use App\Events\NewMessageSent;
use Illuminate\Support\Facades\DB;

class MessageService extends BaseService
{
    public function getMessages($referenceNumber)
    {
        return Message::where('reference_number', $referenceNumber)
                    ->with('sender')
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
    }

    public function sendMessage($data)
    {
        try {
            DB::beginTransaction();

            $message = Message::create($data);

            // Broadcast the new message
            broadcast(new NewMessageSent($message))->toOthers();

            DB::commit();
            return $message;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function markAsRead($message)
    {
        $message->update(['is_read' => true]);
        return $message;
    }

    public function getUnreadCount($referenceNumber, $userId)
    {
        return Message::where('reference_number', $referenceNumber)
                    ->where('sender_id', '!=', $userId)
                    ->where('is_read', false)
                    ->count();
    }
}