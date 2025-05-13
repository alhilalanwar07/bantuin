<?php

use App\Models\Rating;
use App\Models\ServiceProvider;
use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedRatings = [];
    public $selectAll = false;
    public $showBulkActions = false;
    public $bulkAction = '';
    public $filterRating = '';
    public $filterProvider = '';
    public $providers = [];
    public $selectedRating = null;
    public $showDetailModal = false;

    public function mount()
    {
        $this->providers = ServiceProvider::orderBy('name')->get();
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
        $this->selectedRatings = $value 
            ? $this->ratings->pluck('id')->toArray() 
            : [];
        $this->showBulkActions = count($this->selectedRatings) > 0;
    }

    public function updatedSelectedRatings()
    {
        $this->showBulkActions = count($this->selectedRatings) > 0;
    }

    public function resetBulkSelection()
    {
        $this->selectedRatings = [];
        $this->bulkAction = '';
        $this->showBulkActions = false;
        $this->selectAll = false;
    }

    public function applyBulkAction()
    {
        if ($this->bulkAction === 'delete') {
            Rating::whereIn('id', $this->selectedRatings)->delete();
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Rating berhasil dihapus',
            ]);
        } elseif ($this->bulkAction === 'approve') {
            Rating::whereIn('id', $this->selectedRatings)->update(['status' => 'approved']);
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Rating berhasil disetujui',
            ]);
        } elseif ($this->bulkAction === 'reject') {
            Rating::whereIn('id', $this->selectedRatings)->update(['status' => 'rejected']);
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Rating berhasil ditolak',
            ]);
        }
        
        $this->resetBulkSelection();
    }

    public function showDetail($id)
    {
        $this->selectedRating = Rating::with(['user', 'provider'])->find($id);
        $this->showDetailModal = true;
        $this->dispatch('openModal', 'ratingDetailModal');
    }

    public function approveRating($id)
    {
        Rating::find($id)->update(['status' => 'approved']);
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Rating berhasil disetujui',
        ]);
    }

    public function rejectRating($id)
    {
        Rating::find($id)->update(['status' => 'rejected']);
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Rating berhasil ditolak',
        ]);
    }

    public function deleteRating($id)
    {
        Rating::find($id)->delete();
        $this->dispatch('showAlert', [
            'type' => 'success',
            'message' => 'Rating berhasil dihapus',
        ]);
    }

    public function getRatingsProperty()
    {
        return Rating::query()
            ->with(['serviceRequest.provider', 'reviewer'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('reviewer', function ($u) {
                        $u->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('serviceRequest.provider', function ($p) {
                        $p->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('review', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterRating, function ($query) {
                $query->where('score', $this->filterRating);
            })
            ->when($this->filterProvider, function ($query) {
                $query->whereHas('serviceRequest', function($q) {
                    $q->where('provider_id', $this->filterProvider);
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function getAverageRatingProperty()
    {
        return Rating::where('status', 'approved')->avg('score') ?? 0;
    }

    public function getRatingCountsProperty()
    {
        $counts = [];
        for ($i = 1; $i <= 5; $i++) {
            $counts[$i] = Rating::where('score', $i)->where('status', 'approved')->count();
        }
        $total = array_sum($counts);
        
        $percentages = [];
        foreach ($counts as $rating => $count) {
            $percentages[$rating] = $total > 0 ? round(($count / $total) * 100) : 0;
        }
        
        return [
            'counts' => $counts,
            'percentages' => $percentages,
            'total' => $total
        ];
    }

    public function getTopProvidersProperty()
    {
        return ServiceProvider::withCount(['serviceRequests as ratings_count' => function($query) {
                $query->whereHas('rating', function($q) {
                    $q->where('status', 'approved');
                });
            }])
            ->withAvg(['serviceRequests as ratings_avg_score' => function($query) {
                $query->whereHas('rating', function($q) {
                    $q->where('status', 'approved');
                });
            }], 'rating.score')
            ->having('ratings_count', '>', 0)
            ->orderByDesc('ratings_avg_score')
            ->limit(5)
            ->get();
    }
}; ?>

<div>
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white border-bottom-0 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-star me-2"></i>Manajemen Rating
                </h3>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Rating Dashboard -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <h1 class="display-1 fw-bold text-primary mb-0">{{ number_format($this->averageRating, 1) }}</h1>
                            <div class="rating-stars my-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $this->averageRating)
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif ($i - 0.5 <= $this->averageRating)
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-muted mb-0">Berdasarkan {{ $this->ratingCounts['total'] }} ulasan</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Distribusi Rating</h5>
                            <div class="rating-bars">
                                @for ($i = 5; $i >= 1; $i--)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-2">{{ $i }} <i class="fas fa-star text-warning small"></i></div>
                                    <div class="progress flex-grow-1" style="height: 10px;">
                                        <div class="progress-bar bg-{{ $i >= 4 ? 'success' : ($i >= 3 ? 'info' : ($i >= 2 ? 'warning' : 'danger')) }}" 
                                             role="progressbar" 
                                             style="width: {{ $this->ratingCounts['percentages'][$i] }}%"></div>
                                    </div>
                                    <div class="ms-2 text-muted">{{ $this->ratingCounts['percentages'][$i] }}% ({{ $this->ratingCounts['counts'][$i] }})</div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Providers -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Provider Terbaik</h5>
                    <div class="row">
                        @forelse($this->topProviders as $provider)
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="flex-shrink-0">
                                    @if($provider->profile_photo)
                                    <img src="{{ asset('storage/' . $provider->profile_photo) }}" alt="{{ $provider->name }}" class="rounded-circle" width="50" height="50">
                                    @else
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold">{{ $provider->name }}</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="text-warning me-1">{{ number_format($provider->ratings_avg_rating, 1) }}</div>
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $provider->ratings_avg_rating)
                                                    <i class="fas fa-star text-warning small"></i>
                                                @elseif ($i - 0.5 <= $provider->ratings_avg_rating)
                                                    <i class="fas fa-star-half-alt text-warning small"></i>
                                                @else
                                                    <i class="far fa-star text-warning small"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="ms-1 small text-muted">({{ $provider->ratings_count }})</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                Belum ada provider dengan rating.
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            @if($showBulkActions)
            <div class="alert alert-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ count($selectedRatings) }} rating dipilih</span>
                    <select wire:model="bulkAction" class="form-select w-auto">
                        <option value="">Pilih Aksi</option>
                        <option value="approve">Setujui Rating</option>
                        <option value="reject">Tolak Rating</option>
                        <option value="delete">Hapus Rating</option>
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
                            placeholder="Cari rating...">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-2">
                    <select wire:model.live="filterRating" class="form-select form-select-lg">
                        <option value="">Semua Rating</option>
                        <option value="5">5 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="3">3 Bintang</option>
                        <option value="2">2 Bintang</option>
                        <option value="1">1 Bintang</option>
                    </select>
                </div>
                <div class="col-12 col-md-6 col-xl-2">
                    <select wire:model.live="filterProvider" class="form-select form-select-lg">
                        <option value="">Semua Provider</option>
                        @foreach($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach
                    </select>
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

            <!-- Rating Cards -->
            <div class="row g-4 mb-4">
                @forelse($this->ratings as $rating)
                <div class="col-md-6 col-lg-4">
                    <div class="card rating-card h-100 border-0 shadow-sm">
                        <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" 
                                       wire:model.live="selectedRatings" 
                                       value="{{ $rating->id }}">
                            </div>
                            <div class="rating-badge bg-{{ $rating->status == 'approved' ? 'success' : ($rating->status == 'pending' ? 'warning' : 'danger') }} text-white px-2 py-1 rounded-pill">
                                <i class="fas fa-circle me-1 small"></i>
                                {{ $rating->status == 'approved' ? 'Disetujui' : ($rating->status == 'pending' ? 'Menunggu' : 'Ditolak') }}
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-circle me-3">
                                    @if($rating->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $rating->user->profile_photo_path) }}" alt="{{ $rating->user->name }}" class="rounded-circle" width="50" height="50">
                                    @else
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px;">
                                        {{ strtoupper(substr($rating->user->name, 0, 1)) }}
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $rating->user->name }}</h6>
                                    <p class="text-muted mb-0 small">{{ $rating->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $rating->provider->name }}
                                </span>
                            </div>
                            
                            <p class="review-text mb-0">{{ Str::limit($rating->comment, 100) }}</p>
                            
                            @if(strlen($rating->comment) > 100)
                            <div class="text-center mt-2">
                                <button wire:click="showDetail({{ $rating->id }})" class="btn btn-sm btn-link">
                                    Baca selengkapnya
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-top-0 p-3">
                            <div class="d-flex justify-content-between">
                                <button wire:click="showDetail({{ $rating->id }})" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                                <div>
                                    @if($rating->status != 'approved')
                                    <button wire:click="approveRating({{ $rating->id }})" class="btn btn-sm btn-outline-success me-1">
                                        <i class="fas fa-check me-1"></i> Setujui
                                    </button>
                                    @endif
                                    
                                    @if($rating->status != 'rejected')
                                    <button wire:click="rejectRating({{ $rating->id }})" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="fas fa-ban me-1"></i> Tolak
                                    </button>
                                    @endif
                                    
                                    <button wire:click="deleteRating({{ $rating->id }})" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus rating ini?')">
                                        <i class="fas fa-trash me-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Belum ada data rating.
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $this->ratings->links() }}
            </div>
        </div>
    </div>

    <!-- Rating Detail Modal -->
    <div wire:ignore.self class="modal fade" id="ratingDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white border-bottom-0 py-4">
                    <h5 class="modal-title fw-bold text-primary" id="ratingDetailModalLabel">
                        <i class="fas fa-star me-2"></i>Detail Rating
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    @if($selectedRating)
                    <div class="text-center mb-4">
                        <div class="rating-stars mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $selectedRating->rating)
                                    <i class="fas fa-star fa-2x text-warning"></i>
                                @else
                                    <i class="far fa-star fa-2x text-warning"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="badge bg-{{ $selectedRating->status == 'approved' ? 'success' : ($selectedRating->status == 'pending' ? 'warning' : 'danger') }} text-white px-3 py-2">
                            {{ $selectedRating->status == 'approved' ? 'Disetujui' : ($selectedRating->status == 'pending' ? 'Menunggu' : 'Ditolak') }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Pengguna</h6>
                            <p>{{ $selectedRating->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Provider</h6>
                            <p>{{ $selectedRating->provider->name }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Tanggal</h6>
                        <p>{{ $selectedRating->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Komentar</h6>
                        <div class="p-3 bg-light rounded">
                            {{ $selectedRating->comment }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        @if($selectedRating->status != 'approved')
                        <button wire:click="approveRating({{ $selectedRating->id }})" class="btn btn-success">
                            <i class="fas fa-check me-1"></i> Setujui
                        </button>
                        @endif
                        
                        @if($selectedRating->status != 'rejected')
                        <button wire:click="rejectRating({{ $selectedRating->id }})" class="btn btn-warning">
                            <i class="fas fa-ban me-1"></i> Tolak
                        </button>
                        @endif
                        
                        <button wire:click="deleteRating({{ $selectedRating->id }})" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus rating ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <livewire:_alert />

    <style>
        .rating-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
        }

        .rating-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .avatar-circle {
            border: 2px solid #f8f9fa;
            border-radius: 50%;
            overflow: hidden;
        }

        .rating-stars {
            letter-spacing: 2px;
        }

        .rating-badge {
            font-size: 0.8rem;
        }
    </style>
</div>
