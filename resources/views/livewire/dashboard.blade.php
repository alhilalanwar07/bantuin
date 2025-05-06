<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\ServiceProvider;
use App\Models\Rating;
use Carbon\Carbon;

new class extends Component {
    public $timeframe = 'month';
    public $userStats = [];
    public $requestStats = [];
    public $revenueStats = [];
    public $ratingStats = [];
    public $topProviders = [];
    public $latestRequests = [];
    
    public function mount()
    {
        $this->loadStats();
    }
    
    public function loadStats()
    {
        // Menghitung statistik berdasarkan timeframe yang dipilih
        $startDate = $this->getStartDate();
        
        // Statistik pengguna
        $totalUsers = User::count();
        $newUsers = User::where('created_at', '>=', $startDate)->count();
        $activeUsers = User::where('is_active', true)->count();
        $this->userStats = [
            'total' => $totalUsers,
            'new' => $newUsers,
            'active' => $activeUsers,
            'inactive' => $totalUsers - $activeUsers
        ];
        
        // Statistik permintaan layanan
        $totalRequests = ServiceRequest::count();
        $newRequests = ServiceRequest::where('created_at', '>=', $startDate)->count();
        $completedRequests = ServiceRequest::where('status_id', 4)->count(); // Assuming 4 is completed status
        $pendingRequests = ServiceRequest::whereIn('status_id', [1, 2, 3])->count(); // Assuming 1,2,3 are pending statuses
        $this->requestStats = [
            'total' => $totalRequests,
            'new' => $newRequests,
            'completed' => $completedRequests,
            'pending' => $pendingRequests
        ];
        
        // Statistik pendapatan
        $totalRevenue = ServiceRequest::where('payment_status', 'paid')->sum('agreed_amount');
        $periodRevenue = ServiceRequest::where('payment_status', 'paid')
            ->where('paid_at', '>=', $startDate)
            ->sum('agreed_amount');
        $this->revenueStats = [
            'total' => $totalRevenue,
            'period' => $periodRevenue
        ];
        
        // Statistik rating
        $avgRating = Rating::avg('score') ?: 0;
        $ratingCounts = Rating::selectRaw('score, count(*) as count')
            ->groupBy('score')
            ->pluck('count', 'score')
            ->toArray();
        $this->ratingStats = [
            'average' => round($avgRating, 1),
            'counts' => $ratingCounts
        ];
        
        // Top providers berdasarkan rating
        $this->topProviders = ServiceProvider::join('service_requests', 'service_providers.id', '=', 'service_requests.provider_id')
            ->join('ratings', 'service_requests.reference_number', '=', 'ratings.reference_number')
            ->selectRaw('service_providers.id, service_providers.name, AVG(ratings.score) as avg_rating, COUNT(DISTINCT service_requests.id) as total_services')
            ->groupBy('service_providers.id', 'service_providers.name')
            ->orderBy('avg_rating', 'desc')
            ->limit(5)
            ->get()
            ->toArray();
        
        // Permintaan layanan terbaru
        $this->latestRequests = ServiceRequest::with(['provider', 'specialization', 'status'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }
    
    public function updatedTimeframe()
    {
        $this->loadStats();
    }
    
    private function getStartDate()
    {
        return match($this->timeframe) {
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'quarter' => Carbon::now()->subQuarter(),
            'year' => Carbon::now()->subYear(),
            default => Carbon::now()->subMonth(),
        };
    }
}; ?>

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Dashboard</h1>
            <p class="mb-0">Ringkasan data dan statistik aplikasi BANTUINDONG</p>
        </div>
        <div>
            <select wire:model.live="timeframe" class="form-select">
                <option value="week">Minggu Ini</option>
                <option value="month">Bulan Ini</option>
                <option value="quarter">Kuartal Ini</option>
                <option value="year">Tahun Ini</option>
            </select>
        </div>
    </div>
    
    <!-- Statistik Utama -->
    <div class="row mt-4">
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Pengguna</h2>
                                <h3 class="fw-extrabold mb-1">{{ $userStats['total'] }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Pengguna</h2>
                                <h3 class="fw-extrabold mb-1">{{ $userStats['total'] }}</h3>
                            </div>
                            <small>Baru: <span class="fw-bold">{{ $userStats['new'] }}</span></small>
                            <div class="small d-flex mt-1">
                                <div>Aktif <span class="text-success fw-bold">{{ $userStats['active'] }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Permintaan</h2>
                                <h3 class="fw-extrabold mb-1">{{ $requestStats['total'] }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Permintaan</h2>
                                <h3 class="fw-extrabold mb-1">{{ $requestStats['total'] }}</h3>
                            </div>
                            <small>Baru: <span class="fw-bold">{{ $requestStats['new'] }}</span></small>
                            <div class="small d-flex mt-1">
                                <div>Selesai <span class="text-success fw-bold">{{ $requestStats['completed'] }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Pendapatan</h2>
                                <h3 class="fw-extrabold mb-1">Rp {{ number_format($revenueStats['total'], 0, ',', '.') }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Pendapatan</h2>
                                <h3 class="fw-extrabold mb-1">Rp {{ number_format($revenueStats['total'], 0, ',', '.') }}</h3>
                            </div>
                            <small>Periode: <span class="fw-bold">Rp {{ number_format($revenueStats['period'], 0, ',', '.') }}</span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="d-sm-none">
                                <h2 class="h5">Rating</h2>
                                <h3 class="fw-extrabold mb-1">{{ $ratingStats['average'] }}</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Rating</h2>
                                <h3 class="fw-extrabold mb-1">{{ $ratingStats['average'] }}</h3>
                            </div>
                            <div class="small d-flex mt-1">
                                @for ($i = 5; $i >= 1; $i--)
                                    <div class="me-2">{{ $i }}⭐: {{ $ratingStats['counts'][$i] ?? 0 }}</div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grafik -->
    <div class="row">
        <div class="col-12 col-xl-8 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="fs-5 fw-bold mb-0">Tren Permintaan Layanan</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:400px;">
                        <canvas id="requestsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="fs-5 fw-bold mb-0">Distribusi Rating</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:400px;">
                        <canvas id="ratingsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabel -->
    <div class="row">
        <div class="col-12 col-xl-6 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="fs-5 fw-bold mb-0">Penyedia Layanan Teratas</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">Nama</th>
                                    <th class="border-0">Rating</th>
                                    <th class="border-0 rounded-end">Total Layanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topProviders as $provider)
                                <tr>
                                    <td>{{ $provider['name'] }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold">{{ number_format($provider['avg_rating'], 1) }}</span>
                                            <span class="ms-1">⭐</span>
                                        </div>
                                    </td>
                                    <td>{{ $provider['total_services'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="fs-5 fw-bold mb-0">Permintaan Layanan Terbaru</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">No. Referensi</th>
                                    <th class="border-0">Layanan</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestRequests as $request)
                                <tr>
                                    <td>{{ $request['reference_number'] }}</td>
                                    <td>{{ $request['specialization']['name'] ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ match($request['status_id']) {
                                            1 => 'warning',
                                            2 => 'info',
                                            3 => 'primary',
                                            4 => 'success',
                                            5 => 'danger',
                                            default => 'secondary'
                                        } }}">
                                            {{ $request['status']['name'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($request['agreed_amount'] ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        // Inisialisasi grafik tren permintaan
        const requestsCtx = document.getElementById('requestsChart').getContext('2d');
        const requestsChart = new Chart(requestsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Permintaan Layanan',
                    data: [12, 19, 3, 5, 2, 3, 20, 33, 23, 12, 33, 10],
                    borderColor: '#5e72e4',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Inisialisasi grafik distribusi rating
        const ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
        const ratingsData = @json($ratingStats['counts'] ?? []);
        const ratingsChart = new Chart(ratingsCtx, {
            type: 'pie',
            data: {
                labels: ['1 Bintang', '2 Bintang', '3 Bintang', '4 Bintang', '5 Bintang'],
                datasets: [{
                    data: [
                        ratingsData[1] ?? 0,
                        ratingsData[2] ?? 0,
                        ratingsData[3] ?? 0,
                        ratingsData[4] ?? 0,
                        ratingsData[5] ?? 0
                    ],
                    backgroundColor: [
                        '#f5365c',
                        '#fb6340',
                        '#ffd600',
                        '#2dce89',
                        '#11cdef'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Update grafik saat data berubah
        Livewire.on('statsUpdated', () => {
            // Update data grafik di sini jika diperlukan
        });
    });
</script>
@endpush
