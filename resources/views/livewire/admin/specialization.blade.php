<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Tambahkan ini
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

new class extends Component {
    use WithPagination;
    use WithFileUploads; // Tambahkan ini
    
    public $name = '';
    public $description = '';
    public $is_active = true;
    public $icon; // Ubah menjadi mixed untuk file upload
    public $existingIconPath = null; // Untuk menyimpan path ikon saat edit
    public $editId = null;
    public $search = '';
    public $perPage = 10;

    public function mount() {
        // Inisialisasi komponen
    }

    public function with() {
        return [
            'specializations' => Specialization::when($this->search, function($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate($this->perPage)
        ];
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
    <div class="col-md-12">
        <div class="card card-round">
            <!-- Card Header -->
            <div class="card-header">
                <div class="card-head-row d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Spesialisasi</h4>
                    <div class="card-tools d-flex align-items-center gap-2">
                        <!-- Search and Per Page Selection -->
                        <div class="input-group" style="width: 300px;">
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
                        
                        <!-- Add Specialization Button -->
                        <button
                            wire:click="resetForm"
                            class="btn btn-info btn-sm d-flex align-items-center gap-1"
                            data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="fa fa-plus"></i>
                            <span>Tambah Spesialisasi</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    {{-- ... Bagian Tabel ... --}}
                    <table class="table table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3">#</th>
                                <th class="py-3">Icon</th> {{-- Kolom Icon --}}
                                <th class="py-3">Nama</th>
                                <th class="py-3">Deskripsi</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($specializations as $key => $spec)
                            <tr>
                                <td class="py-2">{{ $key + 1 }}</td>
                                <td class="py-2">
                                    @if($spec->icon && Storage::disk('public')->exists($spec->icon))
                                        <img src="{{ Storage::url($spec->icon) }}" alt="Icon" style="width: 40px; height: 40px; object-fit: cover;"> {{-- Tampilkan gambar --}}
                                    @else
                                        - {{-- Tampilkan strip jika tidak ada gambar --}}
                                    @endif
                                </td>
                                <td class="py-2">{{ $spec->name }}</td>
                                <td class="py-2">{{ Str::limit($spec->description, 30) }}</td>
                                <td class="py-2">
                                    <span class="badge {{ $spec->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $spec->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <div class="d-flex gap-1">
                                        <button
                                            wire:click="edit({{ $spec->id }})"
                                            class="btn btn-primary btn-sm d-flex align-items-center"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            wire:click="delete({{ $spec->id }})"
                                            class="btn btn-danger btn-sm d-flex align-items-center"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus spesialisasi ini?')"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-3">Belum ada data spesialisasi.</td> {{-- Pastikan colspan sesuai --}}
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- ... Pagination ... --}}
                    <div class="mt-3">
                        {{ $specializations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Specialization Modal -->
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editId ? 'Edit' : 'Tambah' }} Spesialisasi</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editId ? 'update' : 'save' }}">
                        <div class="form-group mb-3">
                            <label>Nama Spesialisasi</label>
                            <input type="text" wire:model="name" class="form-control" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            
                            <label class="mt-3">Deskripsi</label>
                            <textarea wire:model="description" class="form-control" rows="3" placeholder="Deskripsi..."></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror

                            <label class="mt-3">Icon (Gambar)</label>
                            <input type="file" wire:model="icon" class="form-control">
                            {{-- Loading state --}}
                            <div wire:loading wire:target="icon" class="text-info mt-1">Uploading...</div>
                            {{-- Preview Gambar --}}
                            @if ($icon && method_exists($icon, 'temporaryUrl'))
                                <img src="{{ $icon->temporaryUrl() }}" class="mt-2" style="width: 100px; height: auto;">
                            @elseif ($existingIconPath && Storage::disk('public')->exists($existingIconPath))
                                <img src="{{ Storage::url($existingIconPath) }}" class="mt-2" style="width: 100px; height: auto;">
                            @endif
                            @error('icon') <span class="text-danger d-block">{{ $message }}</span> @enderror

                            <div class="form-check form-switch mt-3">
                                <input wire:model="is_active" class="form-check-input" type="checkbox" id="isActiveSwitch">
                                <label class="form-check-label" for="isActiveSwitch">Status Aktif</label>
                            </div>
                            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Batal</button>
                            <button type="submit" class="btn btn-primary">{{ $editId ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <livewire:_alert />
</div>
