<?php

use App\Models\ServiceRequest;
use App\Models\ServiceStatus;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

new class extends Component {
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    
    // Detail modal properties
    public $showDetailModal = false;
    public $selectedRequest = null;
    public $statuses = [];
    public $newStatusId = null;
    
    // Confirmation modal properties
    public $showConfirmModal = false;
    public $confirmationTitle = '';
    public $confirmationMessage = '';
    public $confirmationAction = '';
    public $confirmationData = null;

    public function mount()
    {
        $this->statuses = ServiceStatus::all();
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function showDetail($referenceNumber)
    {
        $this->selectedRequest = ServiceRequest::with([
            'provider.user', 
            'specialization', 
            'status', 
            'photos', 
            'progressPhotos', 
            'rating',
            'topBids.provider.user'
        ])->where('reference_number', $referenceNumber)->first();
        
        if ($this->selectedRequest) {
            $this->newStatusId = $this->selectedRequest->status_id;
            $this->showDetailModal = true;
        }
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->selectedRequest = null;
        $this->newStatusId = null;
    }

    public function confirmUpdateStatus()
    {
        if (!$this->selectedRequest || $this->selectedRequest->status_id == $this->newStatusId) {
            return;
        }

        $this->confirmationTitle = 'Change Status';
        $this->confirmationMessage = 'Are you sure you want to change the status of this service request?';
        $this->confirmationAction = 'updateStatus';
        $this->confirmationData = [
            'requestId' => $this->selectedRequest->id,
            'statusId' => $this->newStatusId
        ];
        $this->showConfirmModal = true;
    }

    public function updateStatus()
    {
        if (!$this->confirmationData) {
            return;
        }

        $request = ServiceRequest::find($this->confirmationData['requestId']);
        if ($request) {
            $request->status_id = $this->confirmationData['statusId'];
            $request->save();

            // Update the selected request object to reflect changes
            if ($this->selectedRequest && $this->selectedRequest->id === $request->id) {
                $this->selectedRequest->status_id = $request->status_id;
                $this->selectedRequest->status = ServiceStatus::find($request->status_id);
            }

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Service request status successfully updated!'
            ]);
        }

        $this->closeConfirmModal();
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->confirmationTitle = '';
        $this->confirmationMessage = '';
        $this->confirmationAction = '';
        $this->confirmationData = null;
    }

    public function getServiceRequestsProperty()
    {
        return ServiceRequest::with(['provider.user', 'specialization', 'status'])
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('reference_number', 'like', '%' . $this->search . '%')
                      ->orWhereHas('provider', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('specialization', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status_id', $this->statusFilter);
            })
            ->when($this->dateFilter, function ($query) {
                if ($this->dateFilter === 'today') {
                    return $query->whereDate('created_at', today());
                } elseif ($this->dateFilter === 'week') {
                    return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($this->dateFilter === 'month') {
                    return $query->whereMonth('created_at', now()->month)
                                 ->whereYear('created_at', now()->year);
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function getStatusCountsProperty()
    {
        return DB::table('service_requests')
            ->select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->get()
            ->keyBy('status_id');
    }
}; ?>

<div>
    <!-- Page Header -->
    <div class="page-header">
        <h4 class="page-title">Service Requests</h4>
    </div>

    <!-- Filter & Search -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Search reference, provider, or specialization...">
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label for="statusFilter" class="form-label">Status Filter</label>
                            <select wire:model.live="statusFilter" class="form-select">
                                <option value="">All Statuses</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <label for="dateFilter" class="form-label">Date Filter</label>
                            <select wire:model.live="dateFilter" class="form-select">
                                <option value="">All Time</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="perPage" class="form-label">Display</label>
                            <select wire:model.live="perPage" class="form-select">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="row mb-4">
        @foreach($statuses as $status)
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-{{ $status->color ?? 'primary' }} card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ $status->name }}</p>
                                    <h4 class="card-title">{{ $this->statusCounts[$status->id]->total ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Service Requests Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Service Request List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th wire:click="sortBy('reference_number')" class="cursor-pointer">
                                        Reference No.
                                        @if($sortField === 'reference_number')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Provider</th>
                                    <th>Spesialisasi</th>
                                    <th wire:click="sortBy('scheduled_at')" class="cursor-pointer">
                                        Schedule
                                        @if($sortField === 'scheduled_at')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('budget_amount')" class="cursor-pointer">
                                        Budget
                                        @if($sortField === 'budget_amount')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Status</th>
                                    <th wire:click="sortBy('created_at')" class="cursor-pointer">
                                        Created Date
                                        @if($sortField === 'created_at')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($this->serviceRequests as $request)
                                    <tr>
                                        <td>{{ $request->reference_number }}</td>
                                        <td>{{ $request->provider->name ?? 'Not assigned yet' }}</td>
                                        <td>{{ $request->specialization->name }}</td>
                                        <td>{{ $request->scheduled_at ? $request->scheduled_at->format('d M Y H:i') : 'Not scheduled yet' }}</td>
                                        <td>Rp {{ number_format($request->budget_amount, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $request->status->color ?? 'secondary' }}">{{ $request->status->name }}</span>
                                        </td>
                                        <td>{{ $request->created_at->format('d M Y') }}</td>
                                        <td>
                                            <button wire:click="showDetail('{{ $request->reference_number }}')" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View Details
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No service request data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $this->serviceRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade @if($showDetailModal) show @endif" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" @if($showDetailModal) style="display: block; background-color: rgba(0,0,0,0.5);" @else style="display: none;" @endif>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @if($selectedRequest)
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Service Request Details: {{ $selectedRequest->reference_number }}</h5>
                    <button type="button" class="btn-close" wire:click="closeDetail" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="fw-bold">General Information</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Reference No.</th>
                                            <td>{{ $selectedRequest->reference_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge bg-{{ $selectedRequest->status->color ?? 'secondary' }}">{{ $selectedRequest->status->name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Specialization</th>
                                            <td>{{ $selectedRequest->specialization->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Budget</th>
                                            <td>Rp {{ number_format($selectedRequest->budget_amount, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Agreed Amount</th>
                                            <td>{{ $selectedRequest->agreed_amount ? 'Rp ' . number_format($selectedRequest->agreed_amount, 0, ',', '.') : 'Not agreed yet' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Schedule</th>
                                            <td>{{ $selectedRequest->scheduled_at ? $selectedRequest->scheduled_at->format('d M Y H:i') : 'Not scheduled yet' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created Date</th>
                                            <td>{{ $selectedRequest->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="fw-bold">Provider Information</h6>
                                @if($selectedRequest->provider)
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $selectedRequest->provider->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $selectedRequest->provider->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $selectedRequest->provider->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <span class="badge {{ $selectedRequest->provider->is_available ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $selectedRequest->provider->is_available ? 'Available' : 'Not Available' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">Provider not assigned yet</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Description</h6>
                            <p>{{ $selectedRequest->description ?? 'No description available' }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Service Address</h6>
                            <p>{{ $selectedRequest->service_address }}</p>
                            <div class="d-flex">
                                <span class="me-3"><strong>Latitude:</strong> {{ $selectedRequest->latitude }}</span>
                                <span><strong>Longitude:</strong> {{ $selectedRequest->longitude }}</span>
                            </div>
                        </div>
                    </div>

                    @if($selectedRequest->topBids && $selectedRequest->topBids->count() > 0)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Top Bids</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Provider</th>
                                            <th>Bid Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($selectedRequest->topBids as $bid)
                                        <tr>
                                            <td>{{ $bid->provider->name }}</td>
                                            <td>Rp {{ number_format($bid->bid_amount, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $bid->status->color ?? 'secondary' }}">{{ $bid->status->name }}</span>
                                            </td>
                                            <td>{{ $bid->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($selectedRequest->photos)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Service Photos</h6>
                            <div class="row">
                                @if($selectedRequest->photos->image_1)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $selectedRequest->photos->image_1) }}" class="img-fluid rounded" alt="Foto 1">
                                </div>
                                @endif
                                @if($selectedRequest->photos->image_2)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $selectedRequest->photos->image_2) }}" class="img-fluid rounded" alt="Foto 2">
                                </div>
                                @endif
                                @if($selectedRequest->photos->image_3)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $selectedRequest->photos->image_3) }}" class="img-fluid rounded" alt="Foto 3">
                                </div>
                                @endif
                                @if($selectedRequest->photos->image_4)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $selectedRequest->photos->image_4) }}" class="img-fluid rounded" alt="Foto 4">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($selectedRequest->progressPhotos)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Progress Photos</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h6>Before</h6>
                                    @if($selectedRequest->progressPhotos->before_photo)
                                    <img src="{{ asset('storage/' . $selectedRequest->progressPhotos->before_photo) }}" class="img-fluid rounded" alt="Foto Sebelum">
                                    @else
                                    <p class="text-muted">No photo available</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6>After</h6>
                                    @if($selectedRequest->progressPhotos->after_photo)
                                    <img src="{{ asset('storage/' . $selectedRequest->progressPhotos->after_photo) }}" class="img-fluid rounded" alt="Foto Sesudah">
                                    @else
                                    <p class="text-muted">No photo available</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($selectedRequest->rating)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Rating & Review</h6>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="badge bg-warning text-dark">{{ $selectedRequest->rating->score }}/5</span>
                                </div>
                                <div>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $selectedRequest->rating->score)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p>{{ $selectedRequest->rating->review }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold">Change Status</h6>
                            <div class="d-flex">
                                <select wire:model="newStatusId" class="form-select me-2">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                <button wire:click="confirmUpdateStatus" class="btn btn-primary" {{ $selectedRequest->status_id == $newStatusId ? 'disabled' : '' }}>
                                    Update Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetail">Close</button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade @if($showConfirmModal) show @endif" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" @if($showConfirmModal) style="display: block; background-color: rgba(0,0,0,0.5);" @else style="display: none;" @endif>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">{{ $confirmationTitle }}</h5>
                    <button type="button" class="btn-close" wire:click="closeConfirmModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ $confirmationMessage }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeConfirmModal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $confirmationAction }}">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
