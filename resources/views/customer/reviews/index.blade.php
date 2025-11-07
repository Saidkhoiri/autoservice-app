@extends('layouts.app')

@section('title', 'Review Saya')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Review Saya</h1>
            <p class="text-muted">Daftar semua review yang telah Anda berikan</p>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Daftar Review</h5>
        </div>
        <div class="card-body">
            @if($reviews->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No. Booking</th>
                                <th>Layanan</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td>
                                    <strong>#{{ str_pad($review->booking->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $review->booking->serviceType->name }}</div>
                                    <small class="text-muted">{{ $review->booking->booking_date->format('d/m/Y') }}</small>
                                </td>
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
                                <td>
                                    @if($review->comment)
                                        <div class="text-muted">{{ Str::limit($review->comment, 100) }}</div>
                                    @else
                                        <span class="text-muted">Tidak ada komentar</span>
                                    @endif
                                </td>
                                <td>
                                    @if($review->is_approved)
                                        <span class="badge badge-soft-success">Disetujui</span>
                                    @else
                                        <span class="badge badge-soft-warning">Menunggu Persetujuan</span>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $review->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $review->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-action">
                                        <a href="{{ route('customer.reviews.show', $review) }}" 
                                           class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('customer.reviews.edit', $review) }}" 
                                           class="btn btn-sm btn-soft-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('customer.reviews.destroy', $review) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-star fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum ada review</h4>
                    <p class="text-muted mb-4">Anda belum memberikan review untuk booking apapun</p>
                    <a href="{{ route('customer.bookings.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-calendar-check me-2"></i>
                        Lihat Booking Saya
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
     .badge-soft-warning {
        background-color: rgba(255, 249, 126, 0.96);
        color: #856404;
        font-weight: 600;
        border: 1px solid rgba(255, 193, 7, 0.4);
    }
    .badge-soft-success {
        background-color: rgba(149, 255, 173, 1);
        color: #155724;
        font-weight: 600;
        border: 1px solid rgba(40, 167, 69, 0.4);
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
        background-color: rgba(255, 250, 116, 0.9);
        color: #856404;
        border: 1px solid rgba(255, 193, 7, 0.3);
        transition: 0.2s ease-in-out;
    }
    .btn-soft-warning:hover {
        background-color: rgba(246, 249, 92, 0.3);
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
