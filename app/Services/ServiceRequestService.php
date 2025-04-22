<?php

namespace App\Services;

use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceRequestService extends BaseService
{
    public function getRequests($request)
    {
        $query = ServiceRequest::query();

        if ($request->provider_id) {
            $query->where('provider_id', $request->provider_id);
        }

        if ($request->status_id) {
            $query->where('status_id', $request->status_id);
        }

        if ($request->date_from && $request->date_to) {
            $query->whereBetween('scheduled_at', [$request->date_from, $request->date_to]);
        }

        return $query->with(['provider', 'specialization', 'status', 'photos', 'progressPhotos'])
                    ->latest()
                    ->paginate($request->per_page ?? 10);
    }

    public function createRequest($data)
    {
        try {
            DB::beginTransaction();

            $data['reference_number'] = Str::uuid();
            $request = ServiceRequest::create($data);

            if (isset($data['photos'])) {
                $request->photos()->create($data['photos']);
            }

            DB::commit();
            return $request;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateRequestStatus($request, $data)
    {
        try {
            DB::beginTransaction();

            $request->update([
                'status_id' => $data['status_id'],
                'cancellation_reason' => $data['cancellation_reason'] ?? null
            ]);

            if (isset($data['progress_photos'])) {
                $request->progressPhotos()->updateOrCreate(
                    ['reference_number' => $request->reference_number],
                    $data['progress_photos']
                );
            }

            DB::commit();
            return $request;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePaymentStatus($request, $data)
    {
        try {
            DB::beginTransaction();

            $request->update([
                'payment_status' => $data['payment_status'],
                'payment_method' => $data['payment_method'] ?? null,
                'payment_proof' => $data['payment_proof'] ?? null,
                'paid_at' => $data['payment_status'] === 'paid' ? now() : null
            ]);

            DB::commit();
            return $request;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}