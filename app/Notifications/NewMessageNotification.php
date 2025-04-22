<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'reference_number' => $this->message->reference_number,
            'sender_id' => $this->message->sender_id,
            'content' => $this->message->content
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message_id' => $this->message->id,
            'reference_number' => $this->message->reference_number,
            'sender_id' => $this->message->sender_id,
            'content' => $this->message->content,
            'created_at' => now()->toDateTimeString()
        ]);
    }
}