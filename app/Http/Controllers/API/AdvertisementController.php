<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Http\Resources\AdvertisementResource;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $ads = Advertisement::with('advertiser')
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->paginate(10);
        return AdvertisementResource::collection($ads);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'advertiser_id' => 'required|exists:advertisers,id',
            'banner_image' => 'required|image|max:2048',
            'duration_days' => 'required|integer|min:1',
            'category' => 'required|string|max:100',
            'start_date' => 'required|date|after:today'
        ]);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('advertisements', 'public');
            $validated['banner_image'] = $path;
        }

        $validated['end_date'] = date('Y-m-d', strtotime($validated['start_date'] . " + {$validated['duration_days']} days"));
        $validated['status'] = 'inactive';
        $validated['payment_status'] = 'unpaid';

        $advertisement = Advertisement::create($validated);
        return new AdvertisementResource($advertisement);
    }

    public function show(Advertisement $advertisement)
    {
        return new AdvertisementResource($advertisement->load('advertiser'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:active,inactive',
            'payment_status' => 'sometimes|in:unpaid,paid',
            'start_date' => 'sometimes|date|after:today'
        ]);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('advertisements', 'public');
            $validated['banner_image'] = $path;
        }

        $advertisement->update($validated);
        return new AdvertisementResource($advertisement);
    }

    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return response()->noContent();
    }
}
