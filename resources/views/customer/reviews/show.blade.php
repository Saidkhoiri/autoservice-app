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
            <a href="{{ route('customer.reviews.index') }}" class="btn btn-secondary">
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
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
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
            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    @if($review->user_id == auth()->id())
                        <div class="d-grid gap-2">
                            <a href="{{ route('customer.reviews.edit', $review) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>
                                Edit Review
                            </a>
                            
                            <form action="{{ route('customer.reviews.destroy', $review) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>
                                    Hapus Review
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Review Status Info -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Status Review</h5>
                </div>
                <div class="card-body">
                    @if($review->is_approved)
                        <div class="text-center">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h6 class="text-success">Review Disetujui</h6>
                            <p class="text-muted small">Review Anda telah disetujui dan dapat dilihat oleh semua pengguna.</p>
                        </div>
                    @else
                        <div class="text-center">
                            <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                            <h6 class="text-warning">Menunggu Persetujuan</h6>
                            <p class="text-muted small">Review Anda sedang ditinjau oleh admin. Mohon tunggu beberapa saat.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
