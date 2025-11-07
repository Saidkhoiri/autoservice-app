@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Detail Booking</h1>
            <p class="text-muted">Booking #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Booking Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Booking</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">No. Booking:</td>
                                    <td>#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Booking:</td>
                                    <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Waktu Booking:</td>
                                    <td>{{ $booking->booking_time }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status:</td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="badge bg-info">Dikonfirmasi</span>
                                        @elseif($booking->status == 'in_progress')
                                            <span class="badge bg-primary">Sedang Diproses</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">Layanan:</td>
                                    <td>{{ $booking->serviceType->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Harga:</td>
                                    <td class="text-primary font-weight-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Durasi:</td>
                                    <td>{{ $booking->serviceType->duration_minutes }} menit</td>
                                </tr>
                                @if($booking->technician)
                                <tr>
                                    <td class="font-weight-bold">Teknisi:</td>
                                    <td>{{ $booking->technician->name }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    @if($booking->notes)
                    <div class="mt-3">
                        <h6 class="font-weight-bold">Catatan:</h6>
                        <p class="text-muted">{{ $booking->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Vehicle Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Kendaraan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">Nomor Kendaraan:</td>
                                    <td>{{ $booking->vehicle_number }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Merek:</td>
                                    <td>{{ $booking->vehicle_brand }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Model:</td>
                                    <td>{{ $booking->vehicle_model }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Layanan</h5>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-bold">{{ $booking->serviceType->name }}</h6>
                    <p class="text-muted">{{ $booking->serviceType->description }}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="text-muted">Durasi:</span>
                            <span class="font-weight-bold">{{ $booking->serviceType->duration_minutes }} menit</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted">Harga:</span>
                            <span class="font-weight-bold text-primary">Rp {{ number_format($booking->serviceType->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pelanggan</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                    </div>
                    <h6 class="font-weight-bold text-center">{{ $booking->user->name }}</h6>
                    <p class="text-muted text-center">{{ $booking->user->email }}</p>
                    
                    
                    <div class="mb-2">
                        <small class="text-muted">Telepon:</small>
                        <div>{{ $booking->user->phone }}</div>
                    </div>
                    
                    <div class="mb-2">
                        <small class="text-muted">Alamat:</small>
                        <div>{{ $booking->user->address }}</div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Booking
                        </a>
                        
                        @if($booking->status == 'pending')
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                <i class="fas fa-cog me-2"></i>
                                Update Status
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Review -->
            @if($booking->review)
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Review</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $booking->review->rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        @endfor
                    </div>
                    
                    @if($booking->review->comment)
                        <p class="text-muted">{{ $booking->review->comment }}</p>
                    @endif
                    
                    <small class="text-muted">
                        Diberikan pada {{ $booking->review->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Update Status Modal -->
@if($booking->status == 'pending')
<div class="modal fade" id="updateStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="technician_id" class="form-label">Teknisi (Opsional)</label>
                        <select class="form-select" id="technician_id" name="technician_id">
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
@endsection
