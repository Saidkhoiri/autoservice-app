@extends('layouts.app')

@section('title', 'Detail Review')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Detail Review</h1>
            <p class="text-muted">Review untuk Booking #{{ str_pad($review->booking->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Review Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Review</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="font-weight-bold">Rating:</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-warning me-1"></i>
                                                @else
                                                    <i class="far fa-star text-muted me-1"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2">({{ $review->rating }}/5)</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status:</td>
                                    <td>
                                        @if($review->is_approved)
                                            <span class="badge badge-soft-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-soft-warning">Menunggu Persetujuan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Review:</td>
                                    <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($review->comment)
                    <div class="mt-3">
                        <h6 class="font-weight-bold">Komentar:</h6>
                        <p class="text-muted">{{ $review->comment }}</p>
                    </div>
                    @endif
                </div>
            </div>

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
                                    <td>#{{ str_pad($review->booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Layanan:</td>
                                    <td>{{ $review->booking->serviceType->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Booking:</td>
                                    <td>{{ $review->booking->booking_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Status Booking:</td>
                                    <td>
                                        @if($review->booking->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($review->booking->status == 'confirmed')
                                            <span class="badge bg-info">Dikonfirmasi</span>
                                        @elseif($review->booking->status == 'in_progress')
                                            <span class="badge bg-primary">Sedang Diproses</span>
                                        @elseif($review->booking->status == 'completed')
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
                                    <td class="font-weight-bold">Kendaraan:</td>
                                    <td>{{ $review->booking->vehicle_number }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Merek & Model:</td>
                                    <td>{{ $review->booking->vehicle_brand }} {{ $review->booking->vehicle_model }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Total:</td>
                                    <td class="text-primary font-weight-bold">Rp {{ number_format($review->booking->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @if($review->booking->technician)
                                <tr>
                                    <td class="font-weight-bold">Teknisi:</td>
                                    <td>{{ $review->booking->technician->name }}</td>
                                </tr>
                                @endif
                            </table>
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
                    <h6 class="font-weight-bold text-center">{{ $review->user->name }}</h6>
                    <p class="text-muted text-center">{{ $review->user->email }}</p>
                    
                    <hr>
                    
                    <div class="mb-2">
                        <small class="text-muted">Telepon:</small>
                        <div>{{ $review->user->phone }}</div>
                    </div>
                    
                    <div class="mb-2">
                        <small class="text-muted">Alamat:</small>
                        <div>{{ $review->user->address }}</div>
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
                        @if(!$review->is_approved)
                            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check me-2"></i>
                                    Setujui Review
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.reviews.reject', $review) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-times me-2"></i>
                                    Tolak Review
                                </button>
                            </form>
                        @endif
                        
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.badge-soft-warning {
    background-color: rgba(255, 249, 126, 0.96) !important;
    color: #856404 !important;
}
.badge-soft-success {
    background-color: rgba(149, 255, 173, 1) !important;
    color: #155724 !important;
}
</style>
@endsection
