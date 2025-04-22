<?php

namespace App\Services;

use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ServiceProviderService extends BaseService
{
    public function getProviders($request)
    {
        $query = ServiceProvider::query();
        
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->specialization) {
            $query->whereHas('certifications', function($q) use ($request) {
                $q->where('specialization_id', $request->specialization);
            });
        }

        return $query->with(['certifications', 'specializations'])
                    ->paginate($request->per_page ?? 10);
    }

    public function createProvider($data)
    {
        try {
            DB::beginTransaction();
            
            $provider = ServiceProvider::create($data);
            
            if (isset($data['certifications'])) {
                $provider->certifications()->createMany($data['certifications']);
            }
            
            DB::commit();
            return $provider;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProvider($provider, $data)
    {
        try {
            DB::beginTransaction();
            
            $provider->update($data);
            
            if (isset($data['certifications'])) {
                $provider->certifications()->delete();
                $provider->certifications()->createMany($data['certifications']);
            }
            
            DB::commit();
            return $provider;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}