<?php

use App\Models\Advertiser;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Rule('required', message: 'Nama perusahaan wajib diisi')]
    #[Rule('min:3', message: 'Nama perusahaan minimal 3 karakter')]
    #[Rule('max:100', message: 'Nama perusahaan maksimal 100 karakter')]
    public $company_name = '';

    #[Rule('required', message: 'Nomor telepon wajib diisi')]
    #[Rule('regex:/^[\d\s\-+()]{10,20}$/', message: 'Format nomor telepon tidak valid')]
    public $contact_phone = '';

    #[Rule('required', message: 'Email wajib diisi')]
    #[Rule('email', message: 'Format email tidak valid')]
    public $contact_email = '';

    #[Rule('required', message: 'Alamat bisnis wajib diisi')]
    #[Rule('min:10', message: 'Alamat bisnis terlalu pendek, minimal 10 karakter')]
    public $business_address = '';

    public $editMode = false;
    public $advertiserId;
    public $search = '';
    public $perPage = 10;

    public function with()
    {
        return [
            'advertisers' => Advertiser::when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('company_name', 'like', '%' . $this->search . '%')
                        ->orWhere('contact_phone', 'like', '%' . $this->search . '%')
                        ->orWhere('contact_email', 'like', '%' . $this->search . '%')
                        ->orWhere('business_address', 'like', '%' . $this->search . '%');
                });
            })
                ->latest()
                ->paginate($this->perPage)
        ];
    }

    public function resetForm()
    {
        $this->reset();
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

    public function delete($id)
    {
        $advertiser = Advertiser::find($id);
        if (!$advertiser->advertisements()->exists()) {
            $advertiser->delete();
        } else {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Cannot delete customer with existing advertisements',
                'timer' => 3000
            ]);
            return;
        }
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Customer deleted successfully',
            'reload' => true,
            'timer' => 1000
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}; ?>

<div>
    <div class="col-md-12">
        <div class="card card-round">
            <!-- Card Header -->
            <div class="card-header">
                <div class="card-head-row d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Customers</h4>
                    <div class="card-tools d-flex align-items-center gap-2">
                        <!-- Search and Per Page Selection -->
                        <div class="input-group" style="width: 500px;">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                class="form-control"
                                placeholder="Search...">
                            <select
                                wire:model.live="perPage"
                                class="form-select"
                                style="width: auto;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>

                        <!-- Add Customer Button -->
                        <button
                            wire:click="resetForm"
                            class="btn btn-info btn-sm d-flex align-items-center gap-1"
                            data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="fa fa-plus"></i>
                            <span>Add Customer</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3">#</th>
                                <th class="py-3">Company Name</th>
                                <th class="py-3">Contact Phone</th>
                                <th class="py-3">Email</th>
                                <th class="py-3">Address</th>
                                <th class="py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advertisers as $key => $advertiser)
                            <tr>
                                <td class="py-2">{{ $key + 1 }}</td>
                                <td class="py-2">{{ $advertiser->company_name }}</td>
                                <td class="py-2">{{ $advertiser->contact_phone }}</td>
                                <td class="py-2">{{ $advertiser->contact_email }}</td>
                                <td class="py-2">{{ $advertiser->business_address }}</td>
                                <td class="py-2">
                                    <div class="d-flex gap-1">
                                        <button
                                            wire:click="edit({{ $advertiser->id }})"
                                            class="btn btn-primary btn-sm d-flex align-items-center"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            wire:click="delete({{ $advertiser->id }})"
                                            class="btn btn-danger btn-sm d-flex align-items-center"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $advertisers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editMode ? 'Edit' : 'Add' }} Customer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'save' }}">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" wire:model="company_name" class="form-control">
                            @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Contact Phone</label>
                            <input type="text" wire:model="contact_phone" class="form-control">
                            @error('contact_phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" wire:model="contact_email" class="form-control">
                            @error('contact_email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Business Address</label>
                            <textarea wire:model="business_address" class="form-control"></textarea>
                            @error('business_address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm()">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <livewire:_alert />
</div>