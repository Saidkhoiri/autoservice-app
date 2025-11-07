@extends('layouts.app')

@section('title', 'Booking Saya')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Booking Saya</h1>
            <p class="text-muted">Kelola semua booking Anda</p>
        </div>
        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Buat Booking Baru
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Daftar Booking</h5>
        </div>
        <div class="card-body">
            @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No. Booking</th>
                                <th>Tanggal & Waktu</th>
                                <th>Layanan</th>
                                <th>Kendaraan</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <strong>#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                </td>
                                <td>
                                    <div>{{ $booking->booking_date->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $booking->booking_time }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $booking->serviceType->name }}</div>
                                    <small class="text-muted">{{ $booking->serviceType->description }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $booking->vehicle_number }}</div>
                                    <small class="text-muted">{{ $booking->vehicle_brand }} {{ $booking->vehicle_model }}</small>
                                </td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge badge-soft-warning">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge badge-soft-info">Dikonfirmasi</span>
                                        @if($booking->technician)
                                            <br><small class="text-muted">Teknisi: {{ $booking->technician->name }}</small>
                                        @endif
                                    @elseif($booking->status == 'in_progress')
                                        <span class="badge badge-soft-primary">Sedang Diproses</span>
                                        @if($booking->technician)
                                            <br><small class="text-muted">Teknisi: {{ $booking->technician->name }}</small>
                                        @endif
                                    @elseif($booking->status == 'completed')
                                        <span class="badge badge-soft-success">Selesai</span>
                                        @if($booking->technician)
                                            <br><small class="text-muted">Teknisi: {{ $booking->technician->name }}</small>
                                        @endif
                                    @else
                                        <span class="badge badge-soft-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-bold text-primary">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('bookings.show', $booking) }}" 
                                        class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($booking->status == 'pending')
                                            <a href="{{ route('bookings.edit', $booking) }}" 
                                            class="btn btn-sm btn-soft-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('bookings.destroy', $booking) }}" 
                                                method="POST" class="d-inline" 
                                                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger" title="Batalkan">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($booking->status == 'completed' && !$booking->review)
                                            <a href="{{ route('customer.reviews.create', $booking) }}" 
                                            class="btn btn-sm btn-soft-success" title="Beri Review">
                                                <i class="fas fa-star"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum ada booking</h4>
                    <p class="text-muted mb-4">Mulai dengan membuat booking pertama Anda</p>
                    <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>
                        Buat Booking Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(90deg, #e2e3ffff 0%, #ece5fdff 100%);
        color: #5f3d86ff;
        border-bottom: none;
        padding: 15px 20px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        background-color: #fafafa;
        padding: 1.5rem;
    }

    /* ===== TABLE STYLING ===== */
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

    /* ===== BADGE SOFT COLORS ===== */
    .badge-soft-warning {
        background-color: rgba(255, 193, 7, 0.25);
        color: #856404;
        font-weight: 600;
        border: 1px solid rgba(255, 193, 7, 0.4);
        border-radius: 8px;
        padding: 4px 10px;
    }

    .badge-soft-info {
        background-color: rgba(23, 162, 184, 0.25);
        color: #055160;
        font-weight: 600;
        border: 1px solid rgba(23, 162, 184, 0.4);
        border-radius: 8px;
        padding: 4px 10px;
    }

    .badge-soft-primary {
        background-color: rgba(0, 123, 255, 0.25);
        color: #004085;
        font-weight: 600;
        border: 1px solid rgba(0, 123, 255, 0.4);
        border-radius: 8px;
        padding: 4px 10px;
    }

    .badge-soft-success {
        background-color: rgba(40, 167, 69, 0.25);
        color: #155724;
        font-weight: 600;
        border: 1px solid rgba(40, 167, 69, 0.4);
        border-radius: 8px;
        padding: 4px 10px;
    }

    .badge-soft-danger {
        background-color: rgba(220, 53, 69, 0.25);
        color: #721c24;
        font-weight: 600;
        border: 1px solid rgba(220, 53, 69, 0.4);
        border-radius: 8px;
        padding: 4px 10px;
    }

    /* ===== BUTTON SOFT COLORS ===== */
    .btn-soft-info {
        background-color: rgba(23, 163, 184, 0.28);
        color: #055160;
        border: 1px solid rgba(23, 162, 184, 0.3);
        transition: 0.25s;
        border-radius: 6px;
    }
    .btn-soft-info:hover {
        background-color: rgba(23, 162, 184, 0.4);
        color: #055160;
    }

    .btn-soft-warning {
        background-color: rgba(255, 193, 7, 0.15);
        color: #856404;
        border: 1px solid rgba(255, 193, 7, 0.3);
        transition: 0.25s;
        border-radius: 6px;
    }
    .btn-soft-warning:hover {
        background-color: rgba(255, 193, 7, 0.3);
        color: #856404;
    }

    .btn-soft-danger {
        background-color: rgba(220, 53, 69, 0.15);
        color: #721c24;
        border: 1px solid rgba(220, 53, 69, 0.3);
        transition: 0.25s;
        border-radius: 6px;
    }
    .btn-soft-danger:hover {
        background-color: rgba(220, 53, 69, 0.3);
        color: #721c24;
    }

    .btn-soft-success {
        background-color: rgba(40, 167, 69, 0.15);
        color: #155724;
        border: 1px solid rgba(40, 167, 69, 0.3);
        transition: 0.25s;
        border-radius: 6px;
    }
    .btn-soft-success:hover {
        background-color: rgba(40, 167, 69, 0.3);
        color: #155724;
    }

    /* ===== ACTION BUTTON SPACING ===== */
    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: center;
    }

    .action-buttons .btn {
        padding: 5px 9px;
    }

    /* ===== EMPTY STATE ===== */
    .text-center.py-5 {
        background-color: #ffffff;
        border: 1px dashed #ced4da;
        border-radius: 12px;
    }

    .text-center.py-5:hover {
        background-color: #f8f9fa;
        transition: 0.3s;
    }
</style>

@endsection
