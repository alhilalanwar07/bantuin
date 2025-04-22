<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Http\Resources\ServiceRequestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::with(['provider', 'specialization', 'status'])->paginate(10);
        return ServiceRequestResource::collection($requests);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|exists:service_providers,id',
            'specialization_id' => 'required|exists:specializations,id',
            'service_address' => 'required|string',
            'longitude' => 'required|numeric|between:-180,180',
            'latitude' => 'required|numeric|between:-90,90',
            'scheduled_at' => 'required|date|after:now',
            'budget_amount' => 'required|numeric|min:0',
            'description' => 'required|string'
        ]);

        $validated['reference_number'] = Str::uuid();
        $validated['status_id'] = 1; // Initial status

        $serviceRequest = ServiceRequest::create($validated);
        return new ServiceRequestResource($serviceRequest);
    }

    public function show(ServiceRequest $serviceRequest)
    {
        return new ServiceRequestResource($serviceRequest->load(['provider', 'specialization', 'status']));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status_id' => 'sometimes|exists:service_statuses,id',
            'agreed_amount' => 'sometimes|numeric|min:0',
            'cancellation_reason' => 'required_if:status_id,7|string',
            'payment_status' => 'sometimes|in:pending,paid,failed,refunded',
            'payment_method' => 'required_if:payment_status,paid|string',
            'payment_proof' => 'required_if:payment_status,paid|string'
        ]);

        $serviceRequest->update($validated);
        return new ServiceRequestResource($serviceRequest);
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();
        return response()->noContent();
    }
}
