<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Http\Resources\RatingResource;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $ratings = Rating::with('serviceRequest')
            ->when($request->provider_id, function($query) use ($request) {
                $query->whereHas('serviceRequest', function($q) use ($request) {
                    $q->where('provider_id', $request->provider_id);
                });
            })
            ->paginate(10);
        
        return RatingResource::collection($ratings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number' => 'required|exists:service_requests,reference_number',
            'score' => 'required|integer|between:1,5',
            'review' => 'nullable|string',
            'reviewer_id' => 'required|exists:users,id'
        ]);

        $rating = Rating::create($validated);
        return new RatingResource($rating);
    }

    public function show(Rating $rating)
    {
        return new RatingResource($rating->load('serviceRequest'));
    }

    public function update(Request $request, Rating $rating)
    {
        $validated = $request->validate([
            'score' => 'sometimes|integer|between:1,5',
            'review' => 'nullable|string'
        ]);

        $rating->update($validated);
        return new RatingResource($rating);
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response()->noContent();
    }
}
