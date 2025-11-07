@extends('layouts.app')

@section('title', 'Detail Teknisi')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #e6e6ffff, #dddff5ff);
        color: black;
        border-radius: 10px 10px 0 0 !important;
    }

    .card-header h5 {
        margin: 0;
        font-weight: 600;
    }

    .table th {
        background-color: #f8fafc !important;
        border-bottom: 2px solid #e2e8f0 !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
        transition: background-color 0.2s ease;
    }

    .badge {
        border-radius: 8px;
        font-size: 0.8rem;
    }

    .text-muted {
        color: #94a3b8 !important;
    }

    .fade-in {
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .info-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

        .info-table th, .info-table td {
        padding: 10px 15px;
        vertical-align: middle;
    }

    .info-table th {
        width: 40%;
        background-color: #f9fafb;
        font-weight: 600;
        color: #334155;
        position: relative;
    }

    .info-table th::after {
        content: "";
        position: absolute;
        right: 0;
        top: 8px;
        bottom: 8px;
        width: 1px;
        background-color: #e7e2f0ff;
    }

    .info-table td {
        background-color: #ffffff;
        color: #475569;
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
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Detail Teknisi</h1>
            <p class="text-muted">Informasi lengkap teknisi</p>
        </div>
        <div>
            <a href="{{ route('admin.technicians.edit', $technician) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>
                Edit
            </a>
            <a href="{{ route('admin.technicians.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>

     <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Teknisi</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm"
                             style="width: 90px; height: 90px; background: linear-gradient(135deg, #6366F1, #818CF8);">
                            <i class="fas fa-user-cog fa-2x text-white"></i>
                        </div>
                    </div>

                    <table class="info-table">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $technician->name }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td><i class="fas fa-phone me-2 text-muted"></i>{{ $technician->phone }}</td>
                        </tr>
                        <tr>
                            <th>Spesialisasi</th>
                            <td>
                                @if($technician->specialization)
                                    <i class="fas fa-tools me-2 text-muted"></i>{{ $technician->specialization }}
                                @else
                                    <span class="text-muted">Tidak ada spesialisasi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($technician->is_active)
                                    <span class="badge badge-soft-success">Aktif</span>
                                @else
                                    <span class="badge badge-soft-secondary">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td><i class="fas fa-calendar me-2 text-muted"></i>{{ $technician->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td><i class="fas fa-clock me-2 text-muted"></i>{{ $technician->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Statistik Booking</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-primary">{{ $technician->bookings->count() }}</div>
                                <div class="text-muted">Total Booking</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-warning">{{ $technician->bookings->where('status', 'pending')->count() }}</div>
                                <div class="text-muted">Pending</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-info">{{ $technician->bookings->where('status', 'confirmed')->count() }}</div>
                                <div class="text-muted">Dikonfirmasi</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-success">{{ $technician->bookings->where('status', 'completed')->count() }}</div>
                                <div class="text-muted">Selesai</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Booking</h5>
                </div>
                <div class="card-body">
                    @if($technician->bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($technician->bookings->sortByDesc('created_at')->take(10) as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $booking->user->name }}</div>
                                            <small class="text-muted">{{ $booking->user->email }}</small>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $booking->serviceType->name }}</div>
                                            <small class="text-muted">{{ $booking->serviceType->description }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $booking->booking_date->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $booking->booking_time }}</small>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-soft-warning">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge badge-soft-info">Dikonfirmasi</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge badge-soft-successs">Selesai</span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="badge badge-soft-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.bookings.show', $booking) }}" 
                                               class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if($technician->bookings->count() > 10)
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.bookings.index') }}?technician_id={{ $technician->id }}" 
                                   class="btn btn-outline-primary">
                                    Lihat Semua Booking
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada booking</h5>
                            <p class="text-muted">Teknisi ini belum pernah ditugaskan untuk booking</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
