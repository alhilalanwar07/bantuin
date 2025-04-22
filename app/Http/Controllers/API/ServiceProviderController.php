<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Http\Resources\ServiceProviderResource;
use App\Http\Requests\ServiceProvider\StoreRequest;
use App\Http\Requests\ServiceProvider\UpdateRequest;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    public function index()
    {
        $providers = ServiceProvider::with(['specializations', 'certifications'])->paginate(10);
        return ServiceProviderResource::collection($providers);
    }

    public function store(StoreRequest $request)
    {
        $provider = ServiceProvider::create($request->validated());
        return new ServiceProviderResource($provider);
    }

    public function show(ServiceProvider $provider)
    {
        return new ServiceProviderResource($provider->load(['specializations', 'certifications']));
    }

    public function update(UpdateRequest $request, ServiceProvider $provider)
    {
        $provider->update($request->validated());
        return new ServiceProviderResource($provider);
    }

    public function destroy(ServiceProvider $provider)
    {
        $provider->delete();
        return response()->noContent();
    }
}
