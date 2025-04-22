<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ServiceRequestStatusNotification extends Notification
{
    use Queueable;

    protected $serviceRequest;
    protected $previousStatus;

    public function __construct(ServiceRequest $serviceRequest, $previousStatus)
    {
        $this->serviceRequest = $serviceRequest;
        $this->previousStatus = $previousStatus;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'service_request_id' => $this->serviceRequest->id,
            'reference_number' => $this->serviceRequest->reference_number,
            'previous_status' => $this->previousStatus,
            'new_status' => $this->serviceRequest->status->name,
            'message' => "Service request status changed from {$this->previousStatus} to {$this->serviceRequest->status->name}"
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'service_request_id' => $this->serviceRequest->id,
            'reference_number' => $this->serviceRequest->reference_number,
            'previous_status' => $this->previousStatus,
            'new_status' => $this->serviceRequest->status->name,
            'created_at' => now()->toDateTimeString()
        ]);
    }
}