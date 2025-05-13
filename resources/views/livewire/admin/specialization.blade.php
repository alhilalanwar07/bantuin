<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

new class extends Component {
    use WithPagination;
    use WithFileUploads;
    
    public $name = '';
    public $description = '';
    public $is_active = true;
    public $icon; // Ubah menjadi mixed untuk file upload
    public $existingIconPath = null; // Untuk menyimpan path ikon saat edit
    public $editId = null;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $selectedSpecializations = [];
    public $bulkAction = '';
    public $showBulkActions = false;
    public $selectAll = false;

    public function mount() {
        // Inisialisasi komponen
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

    public function getSpecializationsProperty() {
        return Specialization::when($this->search, function($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function save() {
        $validatedData = $this->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'icon' => 'nullable|image|max:1024' // Validasi untuk gambar (maks 1MB)
        ], [
            'name.required' => 'Nama spesialisasi wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'is_active.required' => 'Status aktif wajib dipilih.',
            'icon.image' => 'File harus berupa gambar.',
            'icon.max' => 'Ukuran gambar maksimal 1MB.'
        ]);
        
        $iconPath = null;
        if ($this->icon) {
            // Simpan gambar ke folder 'public/specialization-icons'
            $iconPath = $this->icon->store('specialization-icons', 'public');
            $validatedData['icon'] = $iconPath; // Simpan path ke data yang divalidasi
        }
        
        Specialization::create($validatedData);
        
        $this->resetForm();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Spesialisasi berhasil ditambahkan!',
            'closeModal' => true,
            'modalId' => 'addModal'
        ]);
    }
    
    public function update() {
        $validatedData = $this->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'icon' => 'nullable|image|max:1024' // Validasi untuk gambar (maks 1MB) - nullable jika tidak ganti gambar
        ], [
            'name.required' => 'Nama spesialisasi wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'is_active.required' => 'Status aktif wajib dipilih.',
            'icon.image' => 'File harus berupa gambar.',
            'icon.max' => 'Ukuran gambar maksimal 1MB.'
        ]);
        
        $spec = Specialization::find($this->editId);
        
        if ($this->icon) {
            // Hapus gambar lama jika ada dan jika ada gambar baru diupload
            if ($spec->icon && Storage::disk('public')->exists($spec->icon)) {
                Storage::disk('public')->delete($spec->icon);
            }
            // Simpan gambar baru
            $iconPath = $this->icon->store('specialization-icons', 'public');
            $spec->icon = $iconPath; // Update path gambar
        }
        
        // Update field lain
        $spec->name = $this->name;
        $spec->description = $this->description;
        $spec->is_active = $this->is_active;
        $spec->save();
        
        $this->resetForm();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Spesialisasi berhasil diupdate!',
            'closeModal' => true,
            'modalId' => 'addModal'
        ]);
    }

    public function edit($id) {
        $spec = Specialization::find($id);
        $this->editId = $id;
        $this->name = $spec->name;
        $this->description = $spec->description;
        $this->is_active = $spec->is_active;
        $this->existingIconPath = $spec->icon; // Simpan path ikon yang sudah ada
        $this->icon = null; // Reset input file
        $this->dispatch('openModal', 'addModal');
    }

    public function delete($id) {
        $spec = Specialization::find($id);
        // Hapus gambar terkait jika ada
        if ($spec->icon && Storage::disk('public')->exists($spec->icon)) {
            Storage::disk('public')->delete($spec->icon);
        }
        $spec->delete(); // Hapus record dari database
        
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Spesialisasi berhasil dihapus!',
            'reload' => false, // Tidak perlu reload jika menggunakan Livewire update
            'timer' => 2000
        ]);
    }

    public function updatedSelectAll($value)
    {
        $this->selectedSpecializations = $value
            ? $this->specializations->pluck('id')->toArray()
            : [];
    }

    public function updatedSelectedSpecializations()
    {
        $this->showBulkActions = count($this->selectedSpecializations) > 0;
    }

    public function applyBulkAction()
    {
        try {
            DB::beginTransaction();
            
            switch($this->bulkAction) {
                case 'activate':
                    Specialization::whereIn('id', $this->selectedSpecializations)
                        ->update(['is_active' => true]);
                    $message = 'Spesialisasi berhasil diaktifkan!';
                    break;
                case 'deactivate':
                    Specialization::whereIn('id', $this->selectedSpecializations)
                        ->update(['is_active' => false]);
                    $message = 'Spesialisasi berhasil dinonaktifkan!';
                    break;
                case 'delete':
                    $specs = Specialization::whereIn('id', $this->selectedSpecializations)->get();
                    
                    foreach($specs as $spec) {
                        if ($spec->icon && Storage::disk('public')->exists($spec->icon)) {
                            Storage::disk('public')->delete($spec->icon);
                        }
                        
                        activity()
                            ->causedBy(auth()->user())
                            ->performedOn($spec)
                            ->log('bulk deleted specialization');
                    }
                    
                    Specialization::whereIn('id', $this->selectedSpecializations)->delete();
                    $message = 'Spesialisasi berhasil dihapus!';
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
    
    public function resetBulkSelection()
    {
        $this->selectedSpecializations = [];
        $this->bulkAction = '';
        $this->showBulkActions = false;
    }

    public function resetForm() {
        $this->name = '';
        $this->description = '';
        $this->is_active = true;
        $this->icon = null; // Reset input file
        $this->existingIconPath = null; // Reset path ikon
        $this->editId = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    public function updatingSearch() {
        $this->resetPage();
    }
}; ?>

<div>
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-certificate me-2"></i>Manajemen Spesialisasi
                </h3>
                <button wire:click="resetForm"
                    class="btn btn-primary rounded-pill px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Spesialisasi
                </button>
            </div>
        </div>

        <div class="card-body p-4">
            @if($showBulkActions)
            <div class="alert alert-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ count($selectedSpecializations) }} spesialisasi dipilih</span>
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
                            placeholder="Cari spesialisasi...">
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
                            <th class="py-3 px-4 bg-light text-uppercase">Icon</th>
                            <th wire:click="sortBy('name')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Nama
                                @if($sortField === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase">Deskripsi</th>
                            <th wire:click="sortBy('is_active')" 
                                class="py-3 px-4 bg-light text-uppercase" style="cursor:pointer">
                                Status
                                @if($sortField === 'is_active')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th class="py-3 px-4 bg-light text-uppercase text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->specializations as $key => $spec)
                        <tr class="border-top">
                            <td class="py-3 px-4">
                                <input type="checkbox" wire:model.live="selectedSpecializations" value="{{ $spec->id }}">
                            </td>
                            <td class="py-3 px-4">
                                @if($spec->icon && Storage::disk('public')->exists($spec->icon))
                                    <img src="{{ Storage::url($spec->icon) }}" alt="Icon" 
                                        class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="avatar avatar-sm bg-light text-primary">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="fw-bold">{{ $spec->name }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-muted">{{ Str::limit($spec->description, 30) }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="badge bg-{{ $spec->is_active ? 'success' : 'danger' }}">
                                    <i class="fas fa-circle me-1 small"></i>
                                    {{ $spec->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button
                                        wire:click="edit({{ $spec->id }})"
                                        class="btn btn-icon btn-sm btn-outline-primary rounded-circle"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button
                                        wire:click="delete({{ $spec->id }})"
                                        class="btn btn-icon btn-sm btn-outline-danger rounded-circle"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus spesialisasi ini?')"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-muted">
                                <i class="fas fa-database me-2"></i>Belum ada data spesialisasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-3">
                {{ $this->specializations->links() }}
            </div>
        </div>
    </div>

    <!-- Specialization Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom-0 py-4">
                    <h5 class="modal-title fw-bold text-primary" id="specializationModalLabel">
                        <i class="fas fa-certificate me-2"></i>{{ $editId ? 'Edit' : 'Tambah' }} Spesialisasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $editId ? 'update' : 'save' }}">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Spesialisasi</label>
                            <input type="text" wire:model="name" class="form-control form-control-lg" placeholder="Masukkan nama spesialisasi" required>
                            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea wire:model="description" class="form-control" rows="3" placeholder="Deskripsi spesialisasi..."></textarea>
                            @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Icon (Gambar)</label>
                            <input type="file" wire:model="icon" class="form-control">
                            <div wire:loading wire:target="icon" class="text-info mt-1">
                                <i class="fas fa-spinner fa-spin me-1"></i>Uploading...
                            </div>
                            
                            @if ($icon && method_exists($icon, 'temporaryUrl'))
                                <div class="mt-2">
                                    <img src="{{ $icon->temporaryUrl() }}" class="rounded" style="width: 100px; height: auto;">
                                </div>
                            @elseif ($existingIconPath && Storage::disk('public')->exists($existingIconPath))
                                <div class="mt-2">
                                    <img src="{{ Storage::url($existingIconPath) }}" class="rounded" style="width: 100px; height: auto;">
                                </div>
                            @endif
                            @error('icon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input wire:model="is_active" class="form-check-input" type="checkbox" id="isActiveSwitch">
                                <label class="form-check-label fw-semibold" for="isActiveSwitch">Status Aktif</label>
                            </div>
                            @error('is_active') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="modal-footer border-top-0 px-0 pb-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click="resetForm">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">
                                {{ $editId ? 'Update' : 'Simpan' }} Spesialisasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <livewire:_alert />
</div>
