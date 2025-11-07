@extends('layouts.app')

@section('title', 'Dashboard - Owner')

@section('content')
<div class="container-fluid">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Dashboard Owner</h1>
            <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <!-- Statistics cards -->
   <div class="row mb-4">
    <!-- Total Booking -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Booking
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBookings }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-primary">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pendapatan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-success">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendapatan Bulan Ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Pendapatan Bulan Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pelanggan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Pelanggan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-warning">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <!-- Recent Bookings -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Terbaru</h6>
                    <a href="{{ route('owner.bookings.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @if($recentBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Booking</th>
                                        <th>Pelanggan</th>
                                        <th>Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBookings as $booking)
                                    <tr>
                                        <td>#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->serviceType->name }}</td>
                                        <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-soft-warning">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge badge-soft-info">Dikonfirmasi</span>
                                            @elseif($booking->status == 'in_progress')
                                                <span class="badge badge-soft-primary">Sedang Diproses</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge badge-soft-success">Selesai</span>
                                            @else
                                                <span class="badge badge-soft-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('owner.bookings.show', $booking) }}" class="btn btn-sm btn-soft-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada booking</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- System Overview -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Sistem</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Total Pelanggan:</small>
                        <div class="font-weight-bold">{{ $totalUsers }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Total Teknisi:</small>
                        <div class="font-weight-bold">{{ $totalTechnicians }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Jenis Layanan:</small>
                        <div class="font-weight-bold">{{ $totalServices }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Booking Pending:</small>
                        <div class="font-weight-bold">{{ $pendingBookings }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Booking Selesai:</small>
                        <div class="font-weight-bold">{{ $completedBookings }}</div>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted">Terakhir Update:</small>
                        <div class="font-weight-bold">{{ now()->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-gradient booking">
                    <i class="fas fa-calendar-check me-2"></i>
                    Kelola Booking
                </a>
                <a href="{{ route('admin.service-types.index') }}" class="btn btn-gradient service">
                    <i class="fas fa-cogs me-2"></i>
                    Jenis Layanan
                </a>
                <a href="{{ route('admin.technicians.index') }}" class="btn btn-gradient tech">
                    <i class="fas fa-user-cog me-2"></i>
                    Teknisi
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-gradient review">
                    <i class="fas fa-star me-2"></i>
                    Review Pelanggan
                </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Bulanan</h6>
    </div>
    <div class="card-body">
        <canvas id="revenueChart" height="80" style="max-height: 250px;"></canvas>
    </div>
</div>
<style>
    .card-body .row.no-gutters.align-items-center {
        align-items: center !important;
        min-height: 80px;
    }
        .text-xs {
        line-height: 1.2;
        min-height: 32px;
    }
       .icon-box {
        width: 45px;
        height: 45px;
        border-radius: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    .bg-primary { background-color: #4e72dfd3 !important; }
    .bg-warning { background-color: #f6c23ec9 !important; }
    .bg-info { background-color: #36b8cccb !important; }
    .bg-success { background-color: #1cc889c9 !important; }
    .btn-gradient {
        color: #fff !important;
        border: none;
        font-weight: 600;
    }

    .btn-gradient.booking {
        background: linear-gradient(45deg, #4facfe, #00f2fe);
    }

    .btn-gradient.service {
        background: linear-gradient(45deg, #36d1dc, #5b86e5);
    }

    .btn-gradient.tech {
        background: linear-gradient(45deg, #f7971e, #ffd200);
        color: #fff !important;
    }

    .btn-gradient.review {
        background: linear-gradient(45deg, #11998e, #38ef7d);
    }

    .btn-gradient:hover {
        opacity: 0.9;
        transform: scale(1.02);
        transition: all 0.2s ease-in-out;
    }
    #revenueChart {
    margin-top: 10px;
    margin-bottom: 10px;
    }

    .card.shadow.mb-4 {
        margin-bottom: 5px !important;
        margin-top: 15px !important;
        padding: 0px 0;
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

    .badge-soft-primary {
        background-color: rgba(0, 123, 255, 0.25);
        color: #004085;
        font-weight: 600;
        border: 1px solid rgba(0, 123, 255, 0.4);
    }

    .badge-soft-success {
        background-color: rgba(40, 167, 69, 0.25);
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
     .btn-soft-info {
        background-color: rgba(23, 163, 184, 0.28);
        color: #055160;
        border: 1px solid rgba(23, 162, 184, 0.3);
        transition: 0.2s ease-in-out;
    }
    .btn-soft-info:hover {
        background-color: rgba(23, 162, 184, 0.3);
        color: #055160;
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($monthlyLabels),
        datasets: [{
            label: 'Pendapatan Bulanan (Rp)',
            data: @json($monthlyData),
            backgroundColor: 'rgba(81, 167, 224, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        },
        plugins: {
            legend: { display: false }
        }
    }
});
</script>
</div>
@endsection