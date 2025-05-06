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
    public $chartData = [];

    public function mount()
    {
        $this->loadStats();
    }

    #[On('loadStats')]
    public function loadStats()
    {
        // Menghitung statistik berdasarkan timeframe yang dipilih
        $startDate = $this->getStartDate();

        // Menyiapkan data untuk chart
        $this->prepareChartData($startDate);

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
        return match ($this->timeframe) {
            'week' => Carbon::now()->subWeek(),
            'month' => Carbon::now()->subMonth(),
            'quarter' => Carbon::now()->subQuarter(),
            'year' => Carbon::now()->subYear(),
            default => Carbon::now()->subMonth(),
        };
    }

    private function prepareChartData($startDate)
    {
        // Menyiapkan data untuk grafik tren permintaan layanan berdasarkan timeframe
        $period = match ($this->timeframe) {
            'week' => 'day',
            'month' => 'day',
            'quarter' => 'week',
            'year' => 'month',
            default => 'day',
        };

        // Mendapatkan label dan data berdasarkan periode
        $labels = [];
        $newRequestsData = [];
        $completedRequestsData = [];
        $pendingRequestsData = [];

        if ($period === 'day') {
            // Data harian untuk periode minggu atau bulan
            $endDate = Carbon::now();
            $currentDate = clone $startDate;

            while ($currentDate <= $endDate) {
                $labels[] = $currentDate->format('d M');

                // Menghitung permintaan baru per hari
                $newRequestsData[] = ServiceRequest::whereDate('created_at', $currentDate->format('Y-m-d'))->count();

                // Menghitung permintaan selesai per hari
                $completedRequestsData[] = ServiceRequest::where('status_id', 4)
                    ->whereDate('updated_at', $currentDate->format('Y-m-d'))
                    ->count();

                // Menghitung permintaan dalam proses per hari
                $pendingRequestsData[] = ServiceRequest::whereIn('status_id', [1, 2, 3])
                    ->whereDate('updated_at', $currentDate->format('Y-m-d'))
                    ->count();

                $currentDate->addDay();
            }
        } elseif ($period === 'week') {
            // Data mingguan untuk periode kuartal
            $endDate = Carbon::now();
            $currentDate = clone $startDate->startOfWeek();

            while ($currentDate <= $endDate) {
                $weekEnd = clone $currentDate->addDays(6);
                $labels[] = 'Minggu ' . $currentDate->format('W');

                // Menghitung permintaan baru per minggu
                $newRequestsData[] = ServiceRequest::whereBetween('created_at', [$currentDate->format('Y-m-d'), $weekEnd->format('Y-m-d')])->count();

                // Menghitung permintaan selesai per minggu
                $completedRequestsData[] = ServiceRequest::where('status_id', 4)
                    ->whereBetween('updated_at', [$currentDate->format('Y-m-d'), $weekEnd->format('Y-m-d')])
                    ->count();

                // Menghitung permintaan dalam proses per minggu
                $pendingRequestsData[] = ServiceRequest::whereIn('status_id', [1, 2, 3])
                    ->whereBetween('updated_at', [$currentDate->format('Y-m-d'), $weekEnd->format('Y-m-d')])
                    ->count();

                $currentDate->addDays(1); // Pindah ke minggu berikutnya
            }
        } else {
            // Data bulanan untuk periode tahun
            $endDate = Carbon::now();
            $currentDate = clone $startDate->startOfMonth();

            while ($currentDate <= $endDate) {
                $labels[] = $currentDate->format('M Y');

                // Menghitung permintaan baru per bulan
                $newRequestsData[] = ServiceRequest::whereYear('created_at', $currentDate->year)
                    ->whereMonth('created_at', $currentDate->month)
                    ->count();

                // Menghitung permintaan selesai per bulan
                $completedRequestsData[] = ServiceRequest::where('status_id', 4)
                    ->whereYear('updated_at', $currentDate->year)
                    ->whereMonth('updated_at', $currentDate->month)
                    ->count();

                // Menghitung permintaan dalam proses per bulan
                $pendingRequestsData[] = ServiceRequest::whereIn('status_id', [1, 2, 3])
                    ->whereYear('updated_at', $currentDate->year)
                    ->whereMonth('updated_at', $currentDate->month)
                    ->count();

                $currentDate->addMonth();
            }
        }

        $this->chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Permintaan Baru',
                    'data' => $newRequestsData,
                ],
                [
                    'label' => 'Permintaan Selesai',
                    'data' => $completedRequestsData,
                ],
                [
                    'label' => 'Dalam Proses',
                    'data' => $pendingRequestsData,
                ]
            ]
        ];

        // Dispatch event untuk update chart
        $this->dispatch('statsUpdated');
    }
}; ?>

<style>
    .legend-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 8px;
        border-radius: 50%;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .transition-base {
        transition: all 0.2s ease;
    }

    .spark-chart {
        width: 80px;
        height: 30px;
        position: relative;
    }

    .sparkline-updated::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.5);
        animation: sparkle 1s ease-out;
        pointer-events: none;
        border-radius: 4px;
    }

    @keyframes sparkle {
        0% {
            opacity: 0.8;
        }

        100% {
            opacity: 0;
        }
    }

    .chart-container {
        position: relative;
    }

    .rating-bars .progress {
        border-radius: 4px;
    }

    .rating-label {
        width: 15px;
        text-align: center;
        font-weight: 500;
    }

    .rating-count {
        width: 30px;
        text-align: right;
        font-size: 0.8rem;
    }

    .icon-box {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
    }

    .fa-spin {
        animation: fa-spin 1s linear infinite;
    }

    @keyframes fa-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="py-4">
    <!-- Header Dashboard dengan Gaya Enterprise -->
    <div class="d-flex justify-content-between w-100 flex-wrap align-items-center mb-3">
        <div class="mb-3 mb-lg-0">
            <h1 class="h3 fw-bold">Analytics Dashboard</h1>
            <p class="mb-0 text-muted">Ringkasan performa dan metrik bisnis BANTUINDONG</p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm {{ $timeframe == 'week' ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="$set('timeframe', 'week')">Minggu</button>
                <button type="button" class="btn btn-sm {{ $timeframe == 'month' ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="$set('timeframe', 'month')">Bulan</button>
                <button type="button" class="btn btn-sm {{ $timeframe == 'quarter' ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="$set('timeframe', 'quarter')">Kuartal</button>
                <button type="button" class="btn btn-sm {{ $timeframe == 'year' ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="$set('timeframe', 'year')">Tahun</button>
            </div>
            <button class="btn btn-sm btn-outline-primary ms-2" id="refreshStats">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="dropdown ms-2">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-download me-1"></i> Export
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="#"><i class="far fa-file-pdf me-1"></i> PDF</a></li>
                    <li><a class="dropdown-item" href="#"><i class="far fa-file-excel me-1"></i> Excel</a></li>
                    <li><a class="dropdown-item" href="#"><i class="far fa-file-csv me-1"></i> CSV</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Summary Stats dengan Animasi dan Visualisasi Modern -->
    <div class="row mt-4">
        <!-- Metrik Pengguna dengan Visualisasi Trend -->
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary-subtle rounded-3 p-3 me-3">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <h6 class="mb-0 text-muted">Total Pengguna</h6>
                        </div>
                        <span class="badge bg-success-subtle text-success p-2">+{{ number_format(($userStats['new'] / max($userStats['total'] - $userStats['new'], 1)) * 100, 1) }}%</span>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ number_format($userStats['total'], 0, ',', '.') }}</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block text-success"><i class="fas fa-arrow-up me-1"></i> {{ $userStats['new'] }} baru</span>
                            <small class="text-muted">Dari periode sebelumnya</small>
                        </div>
                        <div class="spark-chart" id="userSparkline"></div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($userStats['active'] / max($userStats['total'], 1)) * 100 }}%" aria-valuenow="{{ ($userStats['active'] / max($userStats['total'], 1)) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-muted">Aktif: {{ number_format($userStats['active'], 0, ',', '.') }}</small>
                        <small class="text-muted">Tidak Aktif: {{ number_format($userStats['inactive'], 0, ',', '.') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metrik Permintaan Layanan dengan Visualisasi Status -->
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-secondary-subtle rounded-3 p-3 me-3">
                                <i class="fas fa-clipboard-list text-secondary"></i>
                            </div>
                            <h6 class="mb-0 text-muted">Permintaan Layanan</h6>
                        </div>
                        <span class="badge bg-{{ $requestStats['new'] > 10 ? 'success' : 'warning' }}-subtle text-{{ $requestStats['new'] > 10 ? 'success' : 'warning' }} p-2">{{ $requestStats['new'] }} baru</span>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ number_format($requestStats['total'], 0, ',', '.') }}</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block text-{{ $requestStats['completed'] > $requestStats['pending'] ? 'success' : 'warning' }}"><i class="fas fa-{{ $requestStats['completed'] > $requestStats['pending'] ? 'check-circle' : 'clock' }} me-1"></i> {{ number_format($requestStats['completed'], 0, ',', '.') }} selesai</span>
                            <small class="text-muted">{{ number_format($requestStats['pending'], 0, ',', '.') }} dalam proses</small>
                        </div>
                        <div class="spark-chart" id="requestSparkline"></div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($requestStats['completed'] / max($requestStats['total'], 1)) * 100 }}%" aria-valuenow="{{ ($requestStats['completed'] / max($requestStats['total'], 1)) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($requestStats['pending'] / max($requestStats['total'], 1)) * 100 }}%" aria-valuenow="{{ ($requestStats['pending'] / max($requestStats['total'], 1)) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-success">{{ number_format(($requestStats['completed'] / max($requestStats['total'], 1)) * 100, 1) }}% Selesai</small>
                        <small class="text-warning">{{ number_format(($requestStats['pending'] / max($requestStats['total'], 1)) * 100, 1) }}% Dalam Proses</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metrik Pendapatan dengan Visualisasi Trend -->
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success-subtle rounded-3 p-3 me-3">
                                <i class="fas fa-money-bill-wave text-success"></i>
                            </div>
                            <h6 class="mb-0 text-muted">Total Pendapatan</h6>
                        </div>
                        <span class="badge bg-success-subtle text-success p-2">+{{ number_format(($revenueStats['period'] / max($revenueStats['total'] - $revenueStats['period'], 1)) * 100, 1) }}%</span>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">Rp {{ number_format($revenueStats['total'], 0, ',', '.') }}</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block text-success"><i class="fas fa-chart-line me-1"></i> Rp {{ number_format($revenueStats['period'], 0, ',', '.') }}</span>
                            <small class="text-muted">Periode ini</small>
                        </div>
                        <div class="spark-chart" id="revenueSparkline"></div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($revenueStats['period'] / max($revenueStats['total'], 1)) * 100 }}%" aria-valuenow="{{ ($revenueStats['period'] / max($revenueStats['total'], 1)) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span class="ms-2 text-muted small">{{ number_format(($revenueStats['period'] / max($revenueStats['total'], 1)) * 100, 1) }}%</span>
                        </div>
                        <small class="text-muted">dari total pendapatan</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metrik Rating dengan Visualisasi Distribusi -->
        <div class="col-12 col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-warning-subtle rounded-3 p-3 me-3">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <h6 class="mb-0 text-muted">Rating Rata-rata</h6>
                        </div>
                        <div class="rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $ratingStats['average'] ? 'text-warning' : 'text-muted opacity-25' }}"></i>
                                @endfor
                        </div>
                    </div>
                    <h2 class="display-6 fw-bold mb-2">{{ $ratingStats['average'] }} <small class="text-muted fs-6">/ 5</small></h2>
                    <div class="rating-bars mt-3">
                        @for ($i = 5; $i >= 1; $i--)
                        <div class="d-flex align-items-center mb-1">
                            <div class="rating-label me-2">{{ $i }}</div>
                            <div class="progress flex-grow-1" style="height: 8px;">
                                <div class="progress-bar bg-{{ $i >= 4 ? 'success' : ($i == 3 ? 'warning' : 'danger') }}"
                                    role="progressbar"
                                    style="width: {{ (($ratingStats['counts'][$i] ?? 0) / max(array_sum($ratingStats['counts']), 1)) * 100 }}%"
                                    aria-valuenow="{{ (($ratingStats['counts'][$i] ?? 0) / max(array_sum($ratingStats['counts']), 1)) * 100 }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                            <div class="rating-count ms-2">{{ $ratingStats['counts'][$i] ?? 0 }}</div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Analytics Dashboard -->
    <div class="row">
        <!-- Grafik Tren Permintaan Layanan dengan Filter dan Interaktivitas -->
        <div class="col-12 col-xl-8 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Tren Permintaan Layanan</h5>
                    <div class="chart-actions d-flex gap-2">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary active" data-chart-period="daily">Harian</button>
                            <button type="button" class="btn btn-outline-primary" data-chart-period="weekly">Mingguan</button>
                            <button type="button" class="btn btn-outline-primary" data-chart-period="monthly">Bulanan</button>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" id="downloadChartBtn">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-legend d-flex justify-content-center gap-4 mb-3">
                        <div class="d-flex align-items-center">
                            <span class="legend-indicator bg-primary"></span>
                            <span>Permintaan Baru</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="legend-indicator bg-success"></span>
                            <span>Permintaan Selesai</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="legend-indicator bg-warning"></span>
                            <span>Dalam Proses</span>
                        </div>
                    </div>
                    <div class="chart-container" style="position: relative; height:350px;">
                        <canvas id="requestsChart"></canvas>
                    </div>
                    <div class="chart-analysis mt-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary-subtle rounded p-2 me-3">
                                <i class="fas fa-chart-line text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Analisis Tren</h6>
                                <p class="mb-0 text-muted small">Permintaan layanan meningkat <span class="text-success fw-bold">23%</span> dibandingkan periode sebelumnya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualisasi Rating dan Distribusi -->
        <div class="col-12 col-xl-4 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Distribusi Rating</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="chartViewDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-chart-pie me-1"></i> Tampilan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="chartViewDropdown">
                            <li><a class="dropdown-item active" href="#" data-chart-type="pie">Pie Chart</a></li>
                            <li><a class="dropdown-item" href="#" data-chart-type="doughnut">Doughnut Chart</a></li>
                            <li><a class="dropdown-item" href="#" data-chart-type="bar">Bar Chart</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="ratingsChart"></canvas>
                    </div>
                    <div class="chart-analysis mt-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-warning-subtle rounded p-2 me-3">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Analisis Rating</h6>
                                <p class="mb-0 text-muted small">Rating rata-rata adalah <span class="text-warning fw-bold">{{ $ratingStats['average'] }}</span> dari 5 bintang</p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="rating-summary mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Ringkasan Rating</h6>
                            <span class="badge bg-success">{{ $ratingStats['average'] }} / 5</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            @php
                            $total = array_sum($ratingStats['counts'] ?? []);
                            $rating5Percent = ($ratingStats['counts'][5] ?? 0) / max($total, 1) * 100;
                            $rating4Percent = ($ratingStats['counts'][4] ?? 0) / max($total, 1) * 100;
                            $rating3Percent = ($ratingStats['counts'][3] ?? 0) / max($total, 1) * 100;
                            $rating2Percent = ($ratingStats['counts'][2] ?? 0) / max($total, 1) * 100;
                            $rating1Percent = ($ratingStats['counts'][1] ?? 0) / max($total, 1) * 100;
                            @endphp
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $rating5Percent }}%" aria-valuenow="{{ $rating5Percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $rating4Percent }}%" aria-valuenow="{{ $rating4Percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $rating3Percent }}%" aria-valuenow="{{ $rating3Percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-orange" role="progressbar" style="width: {{ $rating2Percent }}%" aria-valuenow="{{ $rating2Percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $rating1Percent }}%" aria-valuenow="{{ $rating1Percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">{{ $total }} ulasan</small>
                            <small class="text-success">{{ number_format(($rating5Percent + $rating4Percent), 1) }}% positif</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables dengan Visualisasi Modern -->
    <div class="row">
        <!-- Penyedia Layanan Teratas dengan Visualisasi Performa -->
        <div class="col-12 col-xl-6 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Penyedia Layanan Teratas</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="providerFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="providerFilterDropdown">
                            <li><a class="dropdown-item active" href="#">Rating Tertinggi</a></li>
                            <li><a class="dropdown-item" href="#">Layanan Terbanyak</a></li>
                            <li><a class="dropdown-item" href="#">Pendapatan Tertinggi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 rounded-start ps-4">Penyedia Layanan</th>
                                    <th class="border-0 text-center">Rating</th>
                                    <th class="border-0 text-center">Layanan</th>
                                    <th class="border-0 rounded-end text-center">Performa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topProviders as $index => $provider)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="provider-rank me-3 fw-bold {{ $index < 3 ? 'text-primary' : 'text-muted' }}">#{{ $index + 1 }}</div>
                                            <div class="provider-avatar bg-{{ ['primary', 'success', 'info', 'warning', 'danger'][$index % 5] }}-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <span class="fw-bold text-{{ ['primary', 'success', 'info', 'warning', 'danger'][$index % 5] }}">{{ substr($provider['name'], 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $provider['name'] }}</h6>
                                                <small class="text-muted">ID: {{ $provider['id'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="rating-stars me-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= round($provider['avg_rating']) ? 'text-warning' : 'text-muted opacity-25' }} small"></i>
                                                    @endfor
                                            </div>
                                            <span class="fw-bold">{{ number_format($provider['avg_rating'], 1) }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary p-2 rounded-pill">{{ $provider['total_services'] }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                @php
                                                $performancePercent = min(($provider['avg_rating'] / 5) * 100, 100);
                                                $performanceClass = $performancePercent >= 80 ? 'bg-success' : ($performancePercent >= 60 ? 'bg-info' : ($performancePercent >= 40 ? 'bg-warning' : 'bg-danger'));
                                                @endphp
                                                <div class="progress-bar {{ $performanceClass }}" role="progressbar" style="width: {{ $performancePercent }}%" aria-valuenow="{{ $performancePercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-{{ $performancePercent >= 80 ? 'success' : ($performancePercent >= 60 ? 'info' : ($performancePercent >= 40 ? 'warning' : 'danger')) }}">{{ number_format($performancePercent, 0) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Tidak ada data penyedia layanan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 border-top">
                        <a href="#" class="btn btn-sm btn-outline-primary w-100">Lihat Semua Penyedia Layanan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Permintaan Layanan Terbaru dengan Status Tracking -->
        <div class="col-12 col-xl-6 mb-4">
            <div class="card border-0 shadow hover-lift transition-base">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Permintaan Layanan Terbaru</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Cari permintaan..." aria-label="Cari permintaan">
                            <button class="btn btn-outline-primary" type="button"><i class="fas fa-search"></i></button>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" type="button">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 rounded-start ps-4">Referensi</th>
                                    <th class="border-0">Layanan</th>
                                    <th class="border-0 text-center">Status</th>
                                    <th class="border-0 text-end pe-4 rounded-end">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestRequests as $request)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">{{ $request['reference_number'] }}</span>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($request['created_at'])->format('d M Y') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="service-icon bg-light rounded p-2 me-2">
                                                <i class="fas fa-tools text-secondary"></i>
                                            </div>
                                            <span>{{ $request['specialization']['name'] ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                        $statusColors = [
                                        1 => ['bg' => 'bg-warning-subtle', 'text' => 'text-warning', 'icon' => 'clock'],
                                        2 => ['bg' => 'bg-info-subtle', 'text' => 'text-info', 'icon' => 'user-check'],
                                        3 => ['bg' => 'bg-primary-subtle', 'text' => 'text-primary', 'icon' => 'tools'],
                                        4 => ['bg' => 'bg-success-subtle', 'text' => 'text-success', 'icon' => 'check-circle'],
                                        5 => ['bg' => 'bg-danger-subtle', 'text' => 'text-danger', 'icon' => 'times-circle'],
                                        ];
                                        $status = $statusColors[$request['status_id']] ?? ['bg' => 'bg-secondary-subtle', 'text' => 'text-secondary', 'icon' => 'question-circle'];
                                        @endphp
                                        <div class="badge {{ $status['bg'] }} {{ $status['text'] }} p-2 d-flex align-items-center">
                                            <i class="fas fa-{{ $status['icon'] }} me-1"></i>
                                            <span>{{ $request['status']['name'] ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="fw-bold">Rp {{ number_format($request['agreed_amount'] ?? 0, 0, ',', '.') }}</span>
                                            <div class="d-flex align-items-center">
                                                <span class="badge {{ $request['payment_status'] == 'paid' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} small me-1">
                                                    <i class="fas fa-{{ $request['payment_status'] == 'paid' ? 'check' : 'clock' }} me-1"></i>
                                                    {{ $request['payment_status'] == 'paid' ? 'Dibayar' : 'Menunggu' }}
                                                </span>
                                                <a href="#" class="btn btn-sm btn-link p-0"><i class="fas fa-external-link-alt"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Tidak ada permintaan layanan terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 border-top d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Menampilkan {{ count($latestRequests) }} dari {{ $requestStats['total'] }} permintaan</span>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua Permintaan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>