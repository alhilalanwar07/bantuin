<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class PaymentStatusNotification extends Notification
{
    use Queueable;

    protected $serviceRequest;

    public function __construct(ServiceRequest $serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
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
            'payment_status' => $this->serviceRequest->payment_status,
            'payment_method' => $this->serviceRequest->payment_method,
            'amount' => $this->serviceRequest->agreed_amount,
            'message' => "Payment status updated to {$this->serviceRequest->payment_status}"
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'service_request_id' => $this->serviceRequest->id,
            'reference_number' => $this->serviceRequest->reference_number,
            'payment_status' => $this->serviceRequest->payment_status,
            'payment_method' => $this->serviceRequest->payment_method,
            'amount' => $this->serviceRequest->agreed_amount,
            'created_at' => now()->toDateTimeString()
        ]);
    }
}