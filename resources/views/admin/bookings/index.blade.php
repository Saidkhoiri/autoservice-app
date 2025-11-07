@extends('layouts.app')

@section('title', 'Kelola Booking')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Kelola Booking</h1>
            <p class="text-muted">Daftar semua booking pelanggan</p>
        </div>
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
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Tanggal & Waktu</th>
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
                                    <div class="font-weight-bold">{{ $booking->user->name }}</div>
                                    <small class="text-muted">{{ $booking->user->phone }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $booking->serviceType->name }}</div>
                                    <small class="text-muted">{{ Str::limit($booking->serviceType->description, 50) }}</small>
                                </td>
                                <td>
                                    <div>{{ $booking->booking_date->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $booking->booking_time }}</small>
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
                                    <div class="btn-action">
                                        <a href="{{ route('admin.bookings.show', $booking) }}" 
                                           class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.bookings.edit', $booking) }}" 
                                           class="btn btn-sm btn-soft-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        @if($booking->status == 'pending')
                                            <button type="button" class="btn btn-sm btn-soft-success" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#updateStatusModal{{ $booking->id }}"
                                                    title="Update Status">
                                                <i class="fas fa-cog"></i>
                                            </button>
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
                    <p class="text-muted">Pelanggan belum membuat booking apapun</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Update Status Modals -->
@foreach($bookings as $booking)
@if($booking->status == 'pending')
<div class="modal fade" id="updateStatusModal{{ $booking->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status Booking #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status{{ $booking->id }}" class="form-label">Status</label>
                        <select class="form-select" id="status{{ $booking->id }}" name="status" required>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="technician_id{{ $booking->id }}" class="form-label">Teknisi (Opsional)</label>
                        <select class="form-select" id="technician_id{{ $booking->id }}" name="technician_id">
                            <option value="">Pilih teknisi</option>
                            @foreach(\App\Models\Technician::active()->get() as $technician)
                                <option value="{{ $technician->id }}" {{ $booking->technician_id == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach
<style>
    /* ===== TABLE STYLING ===== */
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
     .btn-action {
        display: flex;
        gap: 6px;
        justify-content: center;
    }

    .btn-action .btn {
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

    .btn-action a,
    .btn-action form {
        display: inline-block;
        margin-right: 1px;
    }

    .btn-action .btn {
        padding: 4px 8px;
        border-radius: 6px;
    }
    .btn-action {
        display: flex;
        flex-direction: field;
        gap: 3px;
        }
</style>
@endsection
