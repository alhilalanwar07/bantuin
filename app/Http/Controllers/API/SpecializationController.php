<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Http\Resources\SpecializationResource;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::paginate(10);
        return SpecializationResource::collection($specializations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $specialization = Specialization::create($validated);
        return new SpecializationResource($specialization);
    }

    public function show(Specialization $specialization)
    {
        return new SpecializationResource($specialization);
    }

    public function update(Request $request, Specialization $specialization)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean'
        ]);

        $specialization->update($validated);
        return new SpecializationResource($specialization);
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();
        return response()->noContent();
    }
}
