<?php

namespace App\Notifications;

use App\Models\Rating;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewRatingNotification extends Notification
{
    use Queueable;

    protected $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'rating_id' => $this->rating->id,
            'reference_number' => $this->rating->reference_number,
            'score' => $this->rating->score,
            'review' => $this->rating->review,
            'reviewer_id' => $this->rating->reviewer_id,
            'message' => "New rating received: {$this->rating->score} stars"
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'rating_id' => $this->rating->id,
            'reference_number' => $this->rating->reference_number,
            'score' => $this->rating->score,
            'created_at' => now()->toDateTimeString()
        ]);
    }
}