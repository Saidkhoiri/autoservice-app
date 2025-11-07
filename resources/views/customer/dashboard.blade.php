@extends('layouts.app')

@section('title', 'Dashboard - Pelanggan')

@section('content')
<div class="container-fluid">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Dashboard</h1>
            <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!😊</p>
        </div>
        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Buat Booking Baru
        </a>
    </div>

    <!-- Statistics cards -->
    <div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Booking Saya
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookings->count() }}</div>
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

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Booking Selesai
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $bookings->where('status', 'completed')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
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
                            Booking Pending
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $bookings->where('status', 'pending')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
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
                            Booking Dikonfirmasi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $bookings->where('status', 'confirmed')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-box bg-info">
                            <i class="fas fa-thumbs-up"></i>
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
                    <a href="{{ route('customer.bookings.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Layanan</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings->take(5) as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_date->format('d/m/Y') }} {{ $booking->booking_time }}</td>
                                        <td>{{ $booking->serviceType->name }}</td>
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
                                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-soft-info">
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
                            <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary">
                                Buat Booking Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Available Services -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Layanan Tersedia</h6>
                </div>
                <div class="card-body">
                    @foreach($serviceTypes as $service)
                    <div class="border-bottom pb-3 mb-3">
                        <h6 class="font-weight-bold">{{ $service->name }}</h6>
                        <p class="text-muted small mb-2">{{ $service->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary font-weight-bold">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </span>
                            <span class="text-muted small">
                                <i class="fas fa-clock me-1"></i>
                                {{ $service->duration_minutes }} menit
                            </span>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-center">
                        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-2"></i>
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        background-color: #f1f3f5;
        color: #1d1c1cff;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        text-align: center;
        vertical-align: middle;
    }

    .table td {
        border-top: 1px solid #dee2e6;
        vertical-align: middle;
    }

    /* Garis antar kolom */
    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
    }

    /* Efek hover lembut */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.06);
        transition: background-color 0.25s ease;
    }
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

    .btn-soft-warning {
        background-color: rgba(255, 193, 7, 0.15);
        color: #856404;
        border: 1px solid rgba(255, 193, 7, 0.3);
        transition: 0.2s ease-in-out;
    }
    .btn-soft-warning:hover {
        background-color: rgba(255, 193, 7, 0.3);
        color: #856404;
    }

    .btn-soft-danger {
        background-color: rgba(220, 53, 69, 0.15);
        color: #721c24;
        border: 1px solid rgba(220, 53, 69, 0.3);
        transition: 0.2s ease-in-out;
    }
    .btn-soft-danger:hover {
        background-color: rgba(220, 53, 69, 0.3);
        color: #721c24;
    }

    .btn-soft-success {
        background-color: rgba(40, 167, 69, 0.15);
        color: #155724;
        border: 1px solid rgba(40, 167, 69, 0.3);
        transition: 0.2s ease-in-out;
    }
    .btn-soft-success:hover {
        background-color: rgba(40, 167, 69, 0.3);
        color: #155724;
    }

    .action-buttons a,
    .action-buttons form {
        display: inline-block;
        margin-right: 1px;
    }

    .action-buttons .btn {
        padding: 4px 8px;
        border-radius: 6px;
    }
    .action-buttons {
        display: flex;
        flex-direction: field;
        gap: 3px;
        }
</style>
@endsection
