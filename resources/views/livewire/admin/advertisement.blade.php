<?php

use App\Models\Advertisement;
use App\Models\Advertiser;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
    public $selectedAdvertisements = [];
    public $bulkAction = '';
    public $showBulkActions = false;
    public $selectAll = false;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $advertisers = []; // Tambahkan ini

    public function mount()
    {
        $this->start_date = now()->format('Y-m-d');
        $this->calculateEndDate();

        $this->categories = [
            'kategori1',
            'kategori2',
            'kategori3',
        ];
        $this->getAdvertisers();
    }

    public function getAdvertisers()
    {
        $this->advertisers = Advertiser::orderBy('company_name')->get();
    }

    public function getAdvertisementsProperty()
    {
        return Advertisement::with('advertiser')
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
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
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

    public function updatedSelectAll($value)
    {
        $this->selectedAdvertisements = $value
            ? $this->advertisements->pluck('id')->toArray()
            : [];
    }

    public function updatedSelectedAdvertisements()
    {
        $this->showBulkActions = count($this->selectedAdvertisements) > 0;
    }

    public function resetBulkSelection()
    {
        $this->selectedAdvertisements = [];
        $this->bulkAction = '';
        $this->showBulkActions = false;
        $this->selectAll = false;
    }

    public function applyBulkAction()
    {
        try {
            DB::beginTransaction();
            
            switch($this->bulkAction) {
                case 'activate':
                    Advertisement::whereIn('id', $this->selectedAdvertisements)
                        ->update(['status' => 'active']);
                    $message = 'Iklan berhasil diaktifkan!';
                    break;
                case 'deactivate':
                    Advertisement::whereIn('id', $this->selectedAdvertisements)
                        ->update(['status' => 'inactive']);
                    $message = 'Iklan berhasil dinonaktifkan!';
                    break;
                case 'delete':
                    $ads = Advertisement::whereIn('id', $this->selectedAdvertisements)->get();
                    
                    foreach($ads as $ad) {
                        if ($ad->banner_image && Storage::disk('public')->exists($ad->banner_image)) {
                            Storage::disk('public')->delete($ad->banner_image);
                        }
                        
                        activity()
                            ->causedBy(auth()->user())
                            ->performedOn($ad)
                            ->log('bulk deleted advertisement');
                    }
                    
                    Advertisement::whereIn('id', $this->selectedAdvertisements)->delete();
                    $message = 'Iklan berhasil dihapus!';
                    break;
                default:
                    throw new \Exception('Aksi tidak valid');
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
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-ad me-2"></i>Manajemen Iklan
                </h3>
                <button wire:click="resetForm"
                    class="btn btn-primary rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Iklan
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            @if($showBulkActions)
            <div class="alert alert-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ count($selectedAdvertisements) }} iklan dipilih</span>
                    <select wire:model="bulkAction" class="form-select w-auto">
                        <option value="">Pilih Aksi</option>
                        <option value="activate">Aktifkan</option>
                        <option value="deactivate">Nonaktifkan</option>
                        <option value="delete">Hapus</option>
                    </select>
                    <button wire:click="applyBulkAction" class="btn btn-primary ms-2">Terapkan</button>
                    <button wire:click="resetBulkSelection" class="btn btn-link text-danger">Batal</button>
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
                            placeholder="Cari iklan...">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-2">
                    <select wire:model.live="perPage"
                        class="form-select form-select-lg">
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
                            <th wire:click="sortBy('advertiser_id')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Customer
                                @if($sortField === 'advertiser_id')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase">Banner</th>
                            <th wire:click="sortBy('category')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Kategori
                                @if($sortField === 'category')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('duration_days')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Durasi
                                @if($sortField === 'duration_days')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('start_date')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Tanggal
                                @if($sortField === 'start_date')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('status')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Status
                                @if($sortField === 'status')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('payment_status')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Pembayaran
                                @if($sortField === 'payment_status')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->advertisements as $key => $advertisement)
                        <tr class="border-top">
                            <td class="py-3 px-4">
                                <input type="checkbox" wire:model.live="selectedAdvertisements" value="{{ $advertisement->id }}">
                            </td>
                            <td class="py-3 px-4">
                                <div class="fw-bold">{{ $advertisement->advertiser->company_name }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <img src="{{ asset('storage/' . $advertisement->banner_image) }}" 
                                     alt="Banner" 
                                     class="rounded" 
                                     style="max-width: 100px; max-height: 60px; object-fit: cover;">
                            </td>
                            <td class="py-3 px-4">{{ ucfirst($advertisement->category) }}</td>
                            <td class="py-3 px-4">{{ $advertisement->duration_days }} hari</td>
                            <td class="py-3 px-4">
                                <div>{{ $advertisement->start_date->format('d/m/Y') }}</div>
                                <small class="text-muted">s/d {{ $advertisement->end_date->format('d/m/Y') }}</small>
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge bg-{{ $advertisement->status == 'active' ? 'success' : ($advertisement->status == 'pending' ? 'warning' : 'danger') }}">
                                    <i class="fas fa-circle me-1 small"></i>
                                    {{ ucfirst($advertisement->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge bg-{{ $advertisement->payment_status == 'paid' ? 'success' : ($advertisement->payment_status == 'partial' ? 'warning' : 'danger') }}">
                                    <i class="fas fa-circle me-1 small"></i>
                                    {{ ucfirst($advertisement->payment_status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button
                                        wire:click="edit({{ $advertisement->id }})"
                                        class="btn btn-icon btn-sm btn-outline-primary rounded-circle"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button
                                        wire:click="delete({{ $advertisement->id }})"
                                        class="btn btn-icon btn-sm btn-outline-danger rounded-circle"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus iklan ini?')"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="py-4 text-center text-muted">
                                <i class="fas fa-database me-2"></i>Belum ada data iklan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-3">
                {{ $this->advertisements->links() }}
            </div>
        </div>
    </div>

    <!-- Advertisement Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom-0 py-4">
                    <h5 class="modal-title fw-bold text-primary" id="advertisementModalLabel">
                        <i class="fas fa-ad me-2"></i>{{ $editMode ? 'Edit' : 'Tambah' }} Iklan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'save' }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Customer</label>
                                    <select wire:model="advertiser_id" class="form-select form-select-lg">
                                        <option value="">-- Pilih Customer --</option>
                                        @foreach($advertisers as $advertiser)
                                            <option value="{{ $advertiser->id }}">{{ $advertiser->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('advertiser_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Banner Iklan</label>
                                    <input type="file" wire:model="banner_image" class="form-control">
                                    <div wire:loading wire:target="banner_image" class="text-info mt-1">
                                        <i class="fas fa-spinner fa-spin me-1"></i>Uploading...
                                    </div>
                                    @error('banner_image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    
                                    @if($editMode && $temp_image && !$banner_image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $temp_image) }}" 
                                                 alt="Current Banner" 
                                                 class="rounded" 
                                                 style="max-width: 200px; max-height: 120px;">
                                        </div>
                                    @endif
                                    
                                    @if($banner_image)
                                        <div class="mt-2">
                                            <img src="{{ $banner_image->temporaryUrl() }}" 
                                                 alt="Preview" 
                                                 class="rounded" 
                                                 style="max-width: 200px; max-height: 120px;">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select wire:model="category" class="form-select">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Durasi (hari)</label>
                                    <input type="number" wire:model.live="duration_days" class="form-control" min="1">
                                    @error('duration_days') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggal Mulai</label>
                                    <input type="date" wire:model.live="start_date" class="form-control">
                                    @error('start_date') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggal Berakhir</label>
                                    <input type="date" wire:model.live="end_date" class="form-control" readonly>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Status</label>
                                            <select wire:model="status" class="form-select">
                                                @foreach($statuses as $stat)
                                                    <option value="{{ $stat }}">{{ ucfirst($stat) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Status Pembayaran</label>
                                            <select wire:model="payment_status" class="form-select">
                                                @foreach($payment_statuses as $pstat)
                                                    <option value="{{ $pstat }}">{{ ucfirst($pstat) }}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer border-top-0 px-0 pb-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click="resetForm">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">
                                {{ $editMode ? 'Update' : 'Simpan' }} Iklan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <livewire:_alert />
</div>
