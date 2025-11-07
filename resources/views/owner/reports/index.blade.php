@extends('layouts.app')

@section('title', 'Laporan & Analytics')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
       <div>
        <h1 class="h3 mb-0">
            <i class="fas fa-chart-pie me-2" style="color: #64c0cf;"></i>
            Laporan & Analytics
        </h1>
            <p class="text-muted">Dashboard analitik untuk monitoring bisnis bengkel</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="exportReport()">
                <i class="fas fa-download me-2"></i>
                Export Laporan
            </button>
            <button class="btn btn-primary" onclick="refreshData()">
                <i class="fas fa-sync-alt me-2"></i>
                Refresh Data
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pendapatan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Booking
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalBookings }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Customer
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalCustomers }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Rating Rata-rata
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($averageRating, 1) }} ⭐
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Revenue Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-line me-2"></i>
                        Grafik Pendapatan Bulanan
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                            <div class="dropdown-header">Opsi Grafik:</div>
                            <a class="dropdown-item" href="#" onclick="changeChartType('line')">Garis</a>
                            <a class="dropdown-item" href="#" onclick="changeChartType('bar')">Bar</a>
                            <a class="dropdown-item" href="#" onclick="changeChartType('area')">Area</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Status Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie me-2"></i>
                        Status Booking
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="bookingStatusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #f8c442ff;"></i> Pending
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #3fcbe0ff;"></i> Dikonfirmasi
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #2ada3cff;"></i> Selesai
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #f14839ff;"></i> Dibatalkan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Performance & Top Technicians -->
    <div class="row mb-4">
        <!-- Service Performance -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i>
                        Performa Layanan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="servicePerformanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Technicians -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-trophy me-2"></i>
                        Top Technicians
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="technicianPerformanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Stats -->
    <div class="row">
        <!-- Recent Bookings -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clock me-2"></i>
                        Booking Terbaru
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Layanan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                                <span class="text-white fw-bold">{{ substr($booking->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $booking->user->name }}</div>
                                                <small class="text-muted">{{ $booking->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $booking->serviceType->name }}</td>
                                    <td>{{ $booking->booking_date->format('d M Y') }}</td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge badge-soft-warning">Pending</span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="badge badge-soft-info">Dikonfirmasi</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="badge badge-soft-success">Selesai</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge badge-soft-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>
                        Statistik Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm font-weight-bold">Booking Hari Ini</span>
                            <span class="badge bg-primary">{{ $todayBookings }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: {{ ($todayBookings / max($totalBookings, 1)) * 100 }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm font-weight-bold">Pendapatan Bulan Ini</span>
                            <span class="badge bg-success">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: {{ ($monthlyRevenue / max($totalRevenue, 1)) * 100 }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm font-weight-bold">Customer Baru</span>
                            <span class="badge bg-info">{{ $newCustomers }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-info" style="width: {{ ($newCustomers / max($totalCustomers, 1)) * 100 }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm font-weight-bold">Review Baru</span>
                            <span class="badge bg-warning">{{ $newReviews }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: {{ ($newReviews / max($totalReviews, 1)) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.chart-area {
    position: relative;
    height: 20rem;
    width: 100%;
}

.chart-pie {
    position: relative;
    height: 15rem;
    width: 100%;
}

.chart-bar {
    position: relative;
    height: 15rem;
    width: 100%;
}

.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 14px;
}

.text-xs {
    font-size: 0.7rem;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.progress {
    background-color: #eaecf4;
    border-radius: 0.35rem;
}

.progress-bar {
    border-radius: 0.35rem;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.table {
    font-size: 0.875rem;
}

.badge {
    font-size: 0.75rem;
}
  .badge-soft-warning {
        background-color: rgba(255, 193, 7, 0.25);
        color: #856404;
        font-weight: 600;
        border: 1px solid rgba(255, 193, 7, 0.4);
    }

    .badge-soft-info {
        background-color: rgba(23, 162, 184, 0.25);
        color: #055160;
        font-weight: 600;
        border: 1px solid rgba(23, 162, 184, 0.4);
    }

    .badge-soft-success {
        background-color: rgba(149, 255, 173, 1);
        color: #155724;
        font-weight: 600;
        border: 1px solid rgba(40, 167, 69, 0.4);
    }

    .badge-soft-danger {
        background-color: rgba(220, 53, 69, 0.25);
        color: #721c24;
        font-weight: 600;
        border: 1px solid rgba(220, 53, 69, 0.4);
    }
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart configurations
let revenueChart, bookingStatusChart, servicePerformanceChart, technicianPerformanceChart;

// Initialize charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
});

function initializeCharts() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyLabels),
            datasets: [{
                label: 'Pendapatan Bulanan',
                data: @json($monthlyData),
                borderColor: 'rgb(78, 115, 223)',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgb(78, 115, 223)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Booking Status Chart
    const bookingCtx = document.getElementById('bookingStatusChart').getContext('2d');
    bookingStatusChart = new Chart(bookingCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'],
            datasets: [{
                data: @json($bookingStatusData),
                backgroundColor: [
                    '#f8c442ff',
                    '#3fcbe0ff',
                    '#2ada3cff',
                    '#f14839ff'
                ],
                borderWidth: 0,
                hoverBorderWidth: 3,
                hoverBorderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '70%'
        }
    });

    const serviceCtx = document.getElementById('servicePerformanceChart').getContext('2d');
    const serviceGradient = serviceCtx.createLinearGradient(0, 0, 0, 400);
    serviceGradient.addColorStop(0, 'rgba(37, 126, 235, 0.9)');
    serviceGradient.addColorStop(1, 'rgba(147,51,234,0.8)');

    servicePerformanceChart = new Chart(serviceCtx, {
        type: 'bar',
        data: {
            labels: @json($serviceLabels),
            datasets: [{
                label: 'Jumlah Booking',
                data: @json($serviceData),
                backgroundColor: serviceGradient,
                borderRadius: {
                topLeft: 8,
                topRight: 8,
                bottomLeft: 0,
                bottomRight: 0
                },
                borderSkipped: false,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(200,200,200,0.2)' } },
                x: { grid: { display: false } }
            }
        }
    });


    const technicianCtx = document.getElementById('technicianPerformanceChart').getContext('2d');
    const technicianGradient = technicianCtx.createLinearGradient(0, 0, 0, 400);
    technicianGradient.addColorStop(0, 'rgba(16,185,129,0.9)');  // hijau muda
    technicianGradient.addColorStop(1, 'rgba(34,211,238,0.9)');  // toska bawah

    technicianPerformanceChart = new Chart(technicianCtx, {
        type: 'bar',
        data: {
            labels: @json($technicianLabels),
            datasets: [{
                label: 'Jumlah Booking',
                data: @json($technicianData),
                backgroundColor: technicianGradient,
                borderRadius: {
                topLeft: 8,
                topRight: 8,
                bottomLeft: 0,
                bottomRight: 0
                },
                borderSkipped: false,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(200,200,200,0.2)' } },
                x: { grid: { display: false } }
            }
        }
    });

}

function changeChartType(type) {
    if (revenueChart) {
        revenueChart.destroy();
        const ctx = document.getElementById('revenueChart').getContext('2d');
        revenueChart = new Chart(ctx, {
            type: type,
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    label: 'Pendapatan Bulanan',
                    data: @json($monthlyData),
                    borderColor: 'rgb(78, 115, 223)',
                    backgroundColor: type === 'area' ? 'rgba(78, 115, 223, 0.3)' : 'rgba(78, 115, 223, 0.8)',
                    borderWidth: 2,
                    fill: type === 'area',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
}

function exportReport() {
    // Create a temporary link to download the report
    const link = document.createElement('a');
    link.href = '{{ route("owner.reports.export") }}';
    link.download = 'laporan-bengkel-' + new Date().toISOString().split('T')[0] + '.pdf';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function refreshData() {
    location.reload();
}
</script>
@endpush
