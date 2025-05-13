<?php

use App\Models\Advertiser;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

new class extends Component {
    use WithPagination;

    #[Rule('required', message: 'Company name is required')]
    #[Rule('min:3', message: 'Company name must be at least 3 characters')]
    #[Rule('max:100', message: 'Company name may not be greater than 100 characters')]
    #[Rule(
        'required|unique:advertisers,company_name,' . '$this->advertiserId',
        message: 'Company name already exists'
    )]
    public $company_name = '';

    #[Rule('required', message: 'Phone number is required')]
    #[Rule('regex:/^[\d\s\-+()]{10,20}$/', message: 'Invalid phone number format')]
    #[Rule(
        'required|unique:advertisers,contact_phone,' . '$this->advertiserId',
        message: 'Phone number already registered'
    )]
    public $contact_phone = '';

    #[Rule('required', message: 'Email is required')]
    #[Rule('email', message: 'Invalid email format')]
    #[Rule(
        'required|unique:advertisers,contact_email,' . '$this->advertiserId',
        message: 'Email address already in use'
    )]
    public $contact_email = '';

    #[Rule('required', message: 'Business address is required')]
    #[Rule('min:10', message: 'Business address must be at least 10 characters')]
    public $business_address = '';

    public $editMode = false;
    public $advertiserId;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'company_name';
    public $sortDirection = 'asc';

    public $selectedCustomers = [];
    public $bulkAction = '';
    public $showBulkActions = false;

    public $selectAll = false;

    public function mount()
    {
        $this->resetForm();
    }

    public function openCustomerModal()
    {
        $this->resetForm();
        $this->dispatch('openModal', 'customerModal');
    }

    public function updatedSelectAll($value)
    {
        $this->selectedCustomers = $value
            ? $this->advertisers->pluck('id')->toArray()
            : [];
        $this->showBulkActions = count($this->selectedCustomers) > 0;
    }

    public function applyBulkAction()
    {
        try {
            DB::beginTransaction();

            switch ($this->bulkAction) {
                case 'delete':
                    $customers = Advertiser::whereIn('id', $this->selectedCustomers)->get();
                    foreach ($customers as $customer) {
                        activity()
                            ->causedBy(auth()->user())
                            ->performedOn($customer)
                            ->log('bulk deleted customer');
                    }
                    Advertiser::whereIn('id', $this->selectedCustomers)->delete();
                    $message = 'Customers deleted successfully!';
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
        $this->selectedCustomers = [];
        $this->bulkAction = '';
        $this->showBulkActions = false;
        $this->selectAll = false;
    }

    public function updatedSelectedCustomers()
    {
        $this->showBulkActions = count($this->selectedCustomers) > 0;
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

    public function getAdvertisersProperty()
{
    return Advertiser::query()
        ->withCount('advertisements')
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('company_name', 'like', '%' . $this->search . '%')
                    ->orWhere('contact_phone', 'like', '%' . $this->search . '%')
                    ->orWhere('contact_email', 'like', '%' . $this->search . '%')
                    ->orWhere('business_address', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->perPage);
}

    public function resetForm()
    {
        $this->reset(['company_name', 'contact_phone', 'contact_email', 'business_address', 'editMode', 'advertiserId']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();
        Advertiser::create([
            'company_name' => $this->company_name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'business_address' => $this->business_address,
        ]);
        $this->resetForm();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Customer added successfully',
            'closeModal' => true,
            'modalId' => 'customerModal'
        ]);
    }

    public function edit($id)
    {
        $advertiser = Advertiser::findOrFail($id);
        $this->advertiserId = $id;
        $this->company_name = $advertiser->company_name;
        $this->contact_phone = $advertiser->contact_phone;
        $this->contact_email = $advertiser->contact_email;
        $this->business_address = $advertiser->business_address;
        $this->editMode = true;
        $this->dispatch('openModal', 'customerModal');
    }

    public function update()
    {
        $this->validate();
        Advertiser::find($this->advertiserId)->update([
            'company_name' => $this->company_name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'business_address' => $this->business_address
        ]);
        $this->resetForm();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Customer updated successfully',
            'closeModal' => true,
            'modalId' => 'customerModal'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('showConfirmation', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete this customer. This action cannot be undone.',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'onConfirmed' => 'deleteCustomer',
            'data' => ['id' => $id]
        ]);
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $advertiser = Advertiser::findOrFail($id);
                if ($advertiser->advertisements()->exists()) {
                    throw new \Exception('Customer has active advertisements');
                }
                
                activity()
                    ->causedBy(auth()->user())
                    ->performedOn($advertiser)
                    ->log('deleted customer');
                    
                $advertiser->delete();
            });

            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Customer permanently deleted',
                'reload' => true,
                'timer' => 1000
            ]);
        } catch (\Exception $e) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Deletion failed: ' . $e->getMessage()
            ]);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}; ?>

<div>
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-building me-2"></i>Customer Management
                </h3>
                <button wire:click="openCustomerModal"
                    class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus-circle me-2"></i>Add Customer
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            @if($showBulkActions)
            <div class="alert alert-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ count($selectedCustomers) }} customers selected</span>
                    <select wire:model="bulkAction" class="form-select w-auto">
                        <option value="">Select Action</option>
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
                            placeholder="Cari customer...">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-2">
                    <select wire:model.live="perPage" class="form-select form-select-lg">
                        <option value="10">10 per halaman</option>
                        <option value="25">25 per halaman</option>
                        <option value="50">50 per halaman</option>
                        <option value="100">100 per halaman</option>
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
                            <th class="py-3 px-4 bg-light text-uppercase">No</th>
                            <th class="py-3 px-4 bg-light text-uppercase" wire:click="sortBy('company_name')" style="cursor:pointer">
                                Company Name
                                @if($sortField === 'company_name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase" wire:click="sortBy('contact_phone')" style="cursor:pointer">
                                Phone
                                @if($sortField === 'contact_phone')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase" wire:click="sortBy('contact_email')" style="cursor:pointer">
                                Email
                                @if($sortField === 'contact_email')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase">Address</th>
                            <th class="py-3 px-4 bg-light text-uppercase text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->advertisers as $key => $advertiser)
                        <tr class="border-top">
                            <td class="py-3 px-4">
                                <input type="checkbox" wire:model.live="selectedCustomers" value="{{ $advertiser->id }}">
                            </td>
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">
                                <div class="fw-bold">{{ $advertiser->company_name }}</div>
                                <small class="text-muted">{{ $advertiser->advertisements_count }} iklan</small>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-primary">{{ $advertiser->contact_phone }}</div>
                            </td>
                            <td class="py-3 px-4">{{ $advertiser->contact_email }}</td>
                            <td class="py-3 px-4">
                                <span class="badge bg-primary">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ Str::limit($advertiser->business_address, 25) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button
                                        wire:click="edit({{ $advertiser->id }})"
                                        class="btn btn-icon btn-sm btn-outline-primary rounded-circle"
                                        data-bs-tooltip="tooltip"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button
                                        wire:click="confirmDelete({{ $advertiser->id }})"
                                        class="btn btn-icon btn-sm btn-outline-danger rounded-circle"
                                        data-bs-tooltip="tooltip"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-muted">
                                <i class="fas fa-database me-2"></i>No customers found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $this->advertisers->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Modal -->
    <div wire:ignore.self class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom-0 py-4">
                    <h5 class="modal-title fw-bold text-primary" id="customerModalLabel">
                        <i class="fas fa-building me-2"></i>{{ $editMode ? 'Edit' : 'Add' }} Customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm()"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'save' }}">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Company Name</label>
                            <input type="text" wire:model="company_name" class="form-control form-control-lg" placeholder="Enter company name">
                            @error('company_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contact Phone</label>
                            <input type="text" wire:model="contact_phone" class="form-control" placeholder="Enter phone number">
                            @error('contact_phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" wire:model="contact_email" class="form-control" placeholder="Enter email address">
                            @error('contact_email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Business Address</label>
                            <textarea wire:model="business_address" class="form-control" rows="3" placeholder="Enter business address"></textarea>
                            @error('business_address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click="resetForm()">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">
                                {{ $editMode ? 'Update' : 'Save' }} Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <livewire:_alert />
</div>
