@extends('layouts.app')

@section('title', 'Detail Jenis Layanan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Detail Jenis Layanan</h1>
            <p class="text-muted">{{ $serviceType->name }}</p>
        </div>
        <div>
            <a href="{{ route('admin.service-types.edit', $serviceType) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>
                Edit
            </a>
            <a href="{{ route('admin.service-types.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Service Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Layanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">Nama Layanan:</td>
                                    <td>{{ $serviceType->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Harga:</td>
                                    <td class="text-primary font-weight-bold">Rp {{ number_format($serviceType->price, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Durasi:</td>
                                    <td>{{ $serviceType->duration_minutes }} menit</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status:</td>
                                    <td>
                                        @if($serviceType->is_active)
                                            <span class="badge badge-soft-success">Aktif</span>
                                        @else
                                            <span class="badge badge-soft-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6 class="font-weight-bold">Deskripsi:</h6>
                        <p class="text-muted">{{ $serviceType->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Booking Terbaru untuk Layanan Ini</h5>
                </div>
                <div class="card-body">
                    @if($serviceType->bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>No. Booking</th>
                                        <th>Pelanggan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceType->bookings->take(10) as $booking)
                                    <tr>
                                        <td>#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-soft-warning">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge badge-soft-info">Dikonfirmasi</span>
                                            @elseif($booking->status == 'in_progress')
                                                <span class="badge badge-soft-primary">Sedang Diproses</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge badge-soft-successs">Selesai</span>
                                            @else
                                                <span class="badge badge-soft-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada booking untuk layanan ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Statistik Layanan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Total Booking:</small>
                        <div class="font-weight-bold">{{ $serviceType->bookings->count() }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Booking Pending:</small>
                        <div class="font-weight-bold">{{ $serviceType->bookings->where('status', 'pending')->count() }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Booking Selesai:</small>
                        <div class="font-weight-bold">{{ $serviceType->bookings->where('status', 'completed')->count() }}</div>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted">Total Pendapatan:</small>
                        <div class="font-weight-bold text-primary">
                            Rp {{ number_format($serviceType->bookings->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.service-types.edit', $serviceType) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Layanan
                        </a>
                        
                        <form action="{{ route('admin.service-types.toggle', $serviceType) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $serviceType->is_active ? 'secondary' : 'success' }} w-100">
                                <i class="fas fa-{{ $serviceType->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $serviceType->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        
                        @if($serviceType->bookings->count() == 0)
                            <form action="{{ route('admin.service-types.destroy', $serviceType) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>
                                    Hapus Layanan
                                </button>
                            </form>
                        @else
                            <button class="btn btn-danger w-100" disabled title="Tidak dapat dihapus karena sudah ada booking">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Layanan
                            </button>
                        @endif
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
        border-radius: 4px;
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

    /* Garis antar kolom */
    .table-bordered td, .table-bordered th {
        border: 1px solid #dee2e6;
    }

    /* Efek hover lembut */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.06);
        transition: background-color 0.25s ease;
    }
     .badge-soft-success {
        background-color: rgba(86, 255, 125, 0.59);
        color: #155724;
        font-weight: 600;
        border: 1px solid rgba(40, 167, 69, 0.4);
    }

    .badge-soft-secondary {
        background-color: rgba(100, 100, 100, 0.25);
        color: #252525ff;
        font-weight: 600;
        border: 1px solid rgba(73, 73, 73, 0.4);
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

    .badge-soft-successs {
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
    </style>
@endsection
