<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\ServiceProvider;
use App\Models\Specialization;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $specializationFilter = '';
    public $statusFilter = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $specializations = [];
    public $selectedProviders = [];
    public $bulkAction = '';
    public $showBulkActions = false;
    public $lastActivity = [];

    // Form properties
    public $selectedProvider = null;
    public $isModalOpen = false;
    public $name;
    public $phone;
    public $address;
    public $gender;
    public $latitude;
    public $longitude;
    public $is_available = true;
    public $specialization_id;
    public $certifications = [];

    // protected function boot()
    // {
    //     $this->authorize('manage-providers');
    // }

    public function mount()
    {
        $this->lastActivity = cache()->remember('providers_last_activity', 3600, function() {
            return DB::table('activity_log')
                ->where('log_name', 'providers')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        });
        $this->specializations = cache()->remember('active_specializations', 3600, function () {
            return Specialization::where('is_active', true)->get();
        });
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function getProvidersProperty()
    {
        return ServiceProvider::query()
            ->with(['certifications' => function($query) {
                $query->select('id', 'provider_id', 'specialization_id');
            }])
            ->with(['certifications.specialization' => fn($q) => $q->select('id', 'name')])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%')
                        ->orWhere('address', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->specializationFilter, function ($query) {
                $query->whereHas(
                    'certifications',
                    fn($q) =>
                    $q->where('specialization_id', $this->specializationFilter)
                );
            })
            ->when($this->statusFilter !== '', function ($query) {
                $query->where('is_available', $this->statusFilter === 'available');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->select(['id', 'name', 'phone', 'address', 'gender', 'is_available'])
            ->paginate($this->perPage);
    }

    public function openModal($providerId = null)
    {
        $this->resetValidation();
        $this->reset(['name', 'phone', 'address', 'gender', 'latitude', 'longitude', 'specialization_id']);

        if ($providerId) {
            $provider = ServiceProvider::with('certifications')->findOrFail($providerId);
            $this->selectedProvider = $provider;
            $this->name = $provider->name;
            $this->phone = $provider->phone;
            $this->address = $provider->address;
            $this->gender = $provider->gender;
            $this->latitude = $provider->latitude;
            $this->longitude = $provider->longitude;
            $this->is_available = $provider->is_available;
            $this->specialization_id = $provider->specialization_id;
        } else {
            $this->selectedProvider = null;
        }
        $this->dispatch('openModal', 'providerModal');
    }

    public function closeModal()
    {
        $this->dispatch('closeModal', 'providerModal');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20|regex:/^[0-9+\- ]+$/i',
            'address' => 'required|string|min:10',
            'gender' => 'required|in:M,F',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'specialization_id' => 'required|exists:specializations,id',
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
                'gender' => $this->gender,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'is_available' => $this->is_available,
                'specialization_id' => $this->specialization_id,
            ];

            if ($this->selectedProvider) {
                $this->selectedProvider->update($data);
                $message = 'Provider updated successfully!';
            } else {
                ServiceProvider::create($data);
                $message = 'Provider created successfully!';
            }

            DB::commit();
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => $message,
                'closeModal' => true,
                'modalId' => 'providerModal'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
                'modalId' => 'providerModal'
            ]);
        }
    }

    public function delete($providerId)
    {
        try {
            $provider = ServiceProvider::findOrFail($providerId);
            $provider->delete();
            
            activity()
                ->causedBy(auth()->user())
                ->performedOn($provider)
                ->log('deleted provider');
                
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Provider deleted successfully!',
                'reload' => true,
                'timer' => 1000
            ]);
        } catch (\Exception $e) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
    
    public function applyBulkAction()
    {
        try {
            DB::beginTransaction();
            
            switch($this->bulkAction) {
                case 'activate':
                    ServiceProvider::whereIn('id', $this->selectedProviders)
                        ->update(['is_available' => true]);
                    $message = 'Providers set to available successfully!';
                    break;
                case 'deactivate':
                    ServiceProvider::whereIn('id', $this->selectedProviders)
                        ->update(['is_available' => false]);
                    $message = 'Providers set to unavailable successfully!';
                    break;
                case 'delete':
                    $providers = ServiceProvider::whereIn('id', $this->selectedProviders)->get();
                    
                    foreach($providers as $provider) {
                        activity()
                            ->causedBy(auth()->user())
                            ->performedOn($provider)
                            ->log('bulk deleted provider');
                    }
                    
                    ServiceProvider::whereIn('id', $this->selectedProviders)->delete();
                    $message = 'Providers deleted successfully!';
                    break;
                default:
                    throw new \Exception('Invalid bulk action');
            }
            
            DB::commit();
            $this->resetBulkSelection();
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => $message,
                'reload' => true,
                'timer' => 1000
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
    
    public function resetBulkSelection()
    {
        $this->selectedProviders = [];
        $this->bulkAction = '';
        $this->showBulkActions = false;
    }
    
    public function updatedSelectedProviders()
    {
        $this->showBulkActions = count($this->selectedProviders) > 0;
    }

    #[On('notify')]
    public function notify($type, $message)
    {
        $this->dispatch('notify', [
            'type' => $type,
            'message' => $message
        ]);
    }
}; ?>

<div>
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-user-gear me-2"></i>Service Provider Management
                </h3>
                <button wire:click="openModal"
                    class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus-circle me-2"></i>Add Provider
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            @if($showBulkActions)
            <div class="alert alert-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ count($selectedProviders) }} providers selected</span>
                    <select wire:model="bulkAction" class="form-select w-auto">
                        <option value="">Select Action</option>
                        <option value="activate">Set Available</option>
                        <option value="deactivate">Set Unavailable</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <button wire:click="applyBulkAction" class="btn btn-primary ms-2">Apply</button>
                    <button wire:click="resetBulkSelection" class="btn btn-link text-danger">Cancel</button>
                </div>
            </div>
            @endif
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input wire:model.live.debounce.300ms="search" type="search"
                            class="form-control border-start-0"
                            placeholder="Cari penyedia...">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-3">
                    <select wire:model.live="specializationFilter"
                        class="form-select form-select-lg">
                        <option value="">All Specializations</option>
                        @foreach($specializations as $spec)
                        <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-xl-2">
                    <select wire:model.live="statusFilter"
                        class="form-select form-select-lg">
                        <option value="">All Status</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive rounded-3 border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4 bg-light text-uppercase" style="width: 50px;">
                                <input type="checkbox" wire:model.live="selectAll">
                            </th>
                            <th wire:click="sortBy('name')"
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Provider Name
                                @if($sortField === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase">Contact</th>
                            <th class="py-3 px-4 bg-light text-uppercase">Specialization</th>
                            <th class="py-3 px-4 bg-light text-uppercase">Status</th>
                            <th class="py-3 px-4 bg-light text-uppercase text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->providers as $provider)
                        <tr class="border-top">
                            <td class="py-3 px-4">
                                <input type="checkbox" wire:model.live="selectedProviders" value="{{ $provider->id }}">
                            </td>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-3">
                                        {{ strtoupper(substr($provider->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $provider->name }}</div>
                                        <small class="text-muted">{{ $provider->gender == 'M' ? 'Male' : 'Female' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-primary">{{ $provider->phone }}</div>
                                <small class="text-muted">{{ Str::limit($provider->address, 30) }}</small>
                            </td>
                            <td class="py-3 px-4">
                                @foreach($provider->certifications as $cert)
                                <span class="badge rounded-pill bg-opacity-10 bg-success text-white me-1 mb-1">
                                    {{ $cert->specialization->name }}
                                </span>
                                @endforeach
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge bg-{{ $provider->is_available ? 'primary' : 'danger' }}">
                                    <i class="fas fa-circle me-1 small"></i>
                                    {{ $provider->is_available ? 'Tersedia' : 'Sibuk' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button
                                        wire:click="edit({{ $provider->id }})"
                                        class="btn btn-icon btn-sm btn-outline-primary rounded-circle"
                                        data-bs-toggle="tooltip"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button
                                        wire:click="delete({{ $provider->id }})"
                                        class="btn btn-icon btn-sm btn-outline-danger rounded-circle"
                                        data-bs-toggle="tooltip"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-muted">
                                <i class="fas fa-database me-2"></i>No providers found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-3">
                {{ $this->providers->links() }}
            </div>
        </div>
    </div>

    <!-- Provider Modal -->
    <div wire:ignore.self class="modal fade" id="providerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom-0 py-4">
                    <h5 class="modal-title fw-bold text-primary" id="providerModalLabel">
                        <i class="fas fa-user-gear me-2"></i>{{ $selectedProvider ? 'Edit' : 'Add' }} Provider
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm()"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Provider Name</label>
                            <input type="text" wire:model="name" class="form-control form-control-lg" placeholder="Enter provider name">
                            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contact Phone</label>
                            <input type="text" wire:model="phone" class="form-control" placeholder="Enter phone number">
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Gender</label>
                                <select wire:model="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                @error('gender') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Specialization</label>
                                <select wire:model="specialization_id" class="form-select">
                                    <option value="">Select Specialization</option>
                                    @foreach($specializations as $spec)
                                    <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                                    @endforeach
                                </select>
                                @error('specialization_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea wire:model="address" class="form-control" rows="3" placeholder="Enter address"></textarea>
                            @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Latitude</label>
                                <input type="text" wire:model="latitude" class="form-control" placeholder="Enter latitude">
                                @error('latitude') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Longitude</label>
                                <input type="text" wire:model="longitude" class="form-control" placeholder="Enter longitude">
                                @error('longitude') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="is_available" id="is_available">
                                <label class="form-check-label" for="is_available">
                                    Available for service
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click="resetForm()">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">
                                {{ $selectedProvider ? 'Update' : 'Save' }} Provider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <livewire:_alert />
</div>
