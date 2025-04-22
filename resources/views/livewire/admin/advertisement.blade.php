<?php

use App\Models\Advertisement;
use App\Models\Advertiser;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithPagination, WithFileUploads;

    #[Rule('required', message: 'Pilih customer terlebih dahulu')]
    public $advertiser_id = '';
    
    #[Rule('required', message: 'Banner wajib diisi')]
    #[Rule('image', message: 'File harus berupa gambar')]
    #[Rule('max:2048', message: 'Ukuran gambar maksimal 2MB')]
    public $banner_image;
    
    #[Rule('required', message: 'Durasi wajib diisi')]
    #[Rule('numeric', message: 'Durasi harus berupa angka')]
    #[Rule('min:1', message: 'Durasi minimal 1 hari')]
    public $duration_days = 30;
    
    #[Rule('required', message: 'Kategori wajib diisi')]
    public $category = '';
    
    #[Rule('required', message: 'Status wajib diisi')]
    public $status = 'active';
    
    #[Rule('required', message: 'Status pembayaran wajib diisi')]
    public $payment_status = 'unpaid';
    
    #[Rule('required', message: 'Tanggal mulai wajib diisi')]
    #[Rule('date', message: 'Format tanggal tidak valid')]
    public $start_date = '';
    
    public $end_date = '';
    public $temp_image;
    public $editMode = false;
    public $advertisementId;
    public $search = '';
    public $perPage = 10;
    public $categories = ['banner', 'sidebar', 'popup'];
    public $statuses = ['active', 'inactive', 'pending'];
    public $payment_statuses = ['paid', 'unpaid', 'partial'];

    public function mount()
    {
        $this->start_date = now()->format('Y-m-d');
        $this->calculateEndDate();

        $this->categories = [
            'kategori1',
            'kategori2',
            'kategori3',
        ];
    }

    public function with()
    {
        return [
            'advertisements' => Advertisement::with('advertiser')
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->where('category', 'like', '%'.$this->search.'%')
                          ->orWhere('status', 'like', '%'.$this->search.'%')
                          ->orWhere('payment_status', 'like', '%'.$this->search.'%')
                          ->orWhereHas('advertiser', function($adv) {
                              $adv->where('company_name', 'like', '%'.$this->search.'%');
                          });
                    });
                })
                ->latest()
                ->paginate($this->perPage),
            'advertisers' => Advertiser::orderBy('company_name')->get()
        ];
    }

    public function resetForm()
    {
        $this->reset(['advertiser_id', 'banner_image', 'category', 'status', 'payment_status', 'temp_image', 'advertisementId']);
        $this->duration_days = 30;
        $this->start_date = now()->format('Y-m-d');
        $this->calculateEndDate();
        $this->editMode = false;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function calculateEndDate()
    {
        if ($this->start_date && $this->duration_days) {
            $this->end_date = date('Y-m-d', strtotime($this->start_date . ' + ' . $this->duration_days . ' days'));
        }
    }

    public function updatedDurationDays()
    {
        $this->calculateEndDate();
    }

    public function updatedStartDate()
    {
        $this->calculateEndDate();
    }

    public function save()
    {
        $this->validate();
        
        $imagePath = $this->banner_image->store('advertisements', 'public');
        
        Advertisement::create([
            'advertiser_id' => $this->advertiser_id,
            'banner_image' => $imagePath,
            'duration_days' => $this->duration_days,
            'category' => $this->category,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
        
        $this->resetForm();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Iklan berhasil ditambahkan',
            'closeModal' => true,
            'modalId' => 'addModal'
        ]);
    }

    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $this->advertisementId = $id;
        $this->advertiser_id = $advertisement->advertiser_id;
        $this->temp_image = $advertisement->banner_image;
        $this->duration_days = $advertisement->duration_days;
        $this->category = $advertisement->category;
        $this->status = $advertisement->status;
        $this->payment_status = $advertisement->payment_status;
        $this->start_date = $advertisement->start_date->format('Y-m-d');
        $this->end_date = $advertisement->end_date->format('Y-m-d');
        $this->editMode = true;
        $this->dispatch('openModal', 'addModal');
    }

    public function update()
    {
        $rules = [
            'advertiser_id' => 'required',
            'duration_days' => 'required|numeric|min:1',
            'category' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'start_date' => 'required|date',
        ];
        
        if ($this->banner_image) {
            $rules['banner_image'] = 'image|max:2048';
        }
        
        $this->validate($rules);
        
        $advertisement = Advertisement::find($this->advertisementId);
        
        $data = [
            'advertiser_id' => $this->advertiser_id,
            'duration_days' => $this->duration_days,
            'category' => $this->category,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
        
        if ($this->banner_image) {
            // Delete old image
            if ($advertisement->banner_image && Storage::disk('public')->exists($advertisement->banner_image)) {
                Storage::disk('public')->delete($advertisement->banner_image);
            }
            
            // Store new image
            $imagePath = $this->banner_image->store('advertisements', 'public');
            $data['banner_image'] = $imagePath;
        }
        
        $advertisement->update($data);
        
        $this->resetForm();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Iklan berhasil diperbarui',
            'closeModal' => true,
            'modalId' => 'addModal'
        ]);
    }

    public function delete($id)
    {
        $advertisement = Advertisement::find($id);
        
        // Delete image file
        if ($advertisement->banner_image && Storage::disk('public')->exists($advertisement->banner_image)) {
            Storage::disk('public')->delete($advertisement->banner_image);
        }
        
        $advertisement->delete();
        
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Iklan berhasil dihapus',
            'reload' => false,
            'timer' => 2000
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
                    <h4 class="card-title mb-0">Daftar Iklan</h4>
                    <div class="card-tools d-flex align-items-center gap-2">
                        <!-- Search and Per Page Selection -->
                        <div class="input-group" style="width: 500px;">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                class="form-control"
                                placeholder="Cari...">
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
                        
                        <!-- Add Advertisement Button -->
                        <button
                            wire:click="resetForm"
                            class="btn btn-info btn-sm d-flex align-items-center gap-1"
                            data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="fa fa-plus"></i>
                            <span>Tambah Iklan</span>
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
                                <th class="py-3">Customer</th>
                                <th class="py-3">Banner</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3">Durasi</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Pembayaran</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advertisements as $key => $advertisement)
                            <tr>
                                <td class="py-2">{{ $key + 1 }}</td>
                                <td class="py-2">{{ $advertisement->advertiser->company_name }}</td>
                                <td class="py-2">
                                    <img src="{{ asset('storage/' . $advertisement->banner_image) }}" 
                                         alt="Banner" 
                                         class="img-thumbnail" 
                                         style="max-width: 100px; max-height: 60px;">
                                </td>
                                <td class="py-2">{{ ucfirst($advertisement->category) }}</td>
                                <td class="py-2">{{ $advertisement->duration_days }} hari</td>
                                <td class="py-2">
                                    {{ $advertisement->start_date->format('d/m/Y') }} - 
                                    {{ $advertisement->end_date->format('d/m/Y') }}
                                </td>
                                <td class="py-2">
                                    <span class="badge bg-{{ $advertisement->status == 'active' ? 'success' : ($advertisement->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($advertisement->status) }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <span class="badge bg-{{ $advertisement->payment_status == 'paid' ? 'success' : ($advertisement->payment_status == 'partial' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($advertisement->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <div class="d-flex gap-1">
                                        <button
                                            wire:click="edit({{ $advertisement->id }})"
                                            class="btn btn-primary btn-sm d-flex align-items-center"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            wire:click="delete({{ $advertisement->id }})"
                                            class="btn btn-danger btn-sm d-flex align-items-center"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus iklan ini?')"
                                            title="Hapus">
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
                        {{ $advertisements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advertisement Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editMode ? 'Edit' : 'Tambah' }} Iklan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'save' }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Customer</label>
                                    <select wire:model="advertiser_id" class="form-select">
                                        <option value="">-- Pilih Customer --</option>
                                        @foreach($advertisers as $advertiser)
                                            <option value="{{ $advertiser->id }}">{{ $advertiser->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('advertiser_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Banner Iklan</label>
                                    <input type="file" wire:model="banner_image" class="form-control">
                                    <div wire:loading wire:target="banner_image">Uploading...</div>
                                    @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror
                                    
                                    @if($editMode && $temp_image && !$banner_image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $temp_image) }}" 
                                                 alt="Current Banner" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 200px; max-height: 120px;">
                                        </div>
                                    @endif
                                    
                                    @if($banner_image)
                                        <div class="mt-2">
                                            <img src="{{ $banner_image->temporaryUrl() }}" 
                                                 alt="Preview" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 200px; max-height: 120px;">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Kategori</label>
                                    <select wire:model="category" class="form-select">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Durasi (hari)</label>
                                    <input type="number" wire:model.live="duration_days" class="form-control" min="1">
                                    @error('duration_days') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" wire:model.live="start_date" class="form-control">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Tanggal Berakhir</label>
                                    <input type="date" wire:model.live="end_date" class="form-control" readonly>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select wire:model="status" class="form-select">
                                                @foreach($statuses as $stat)
                                                    <option value="{{ $stat }}">{{ ucfirst($stat) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Status Pembayaran</label>
                                            <select wire:model="payment_status" class="form-select">
                                                @foreach($payment_statuses as $pstat)
                                                    <option value="{{ $pstat }}">{{ ucfirst($pstat) }}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_status') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $editMode ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <livewire:_alert />
</div>
