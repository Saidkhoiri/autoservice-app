@extends('layouts.app')

@section('title', 'Kelola Review')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Kelola Review</h1>
            <p class="text-muted">Daftar semua review dari pelanggan</p>
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
                                <th>Pelanggan</th>
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
                                    <div class="font-weight-bold">{{ $review->user->name }}</div>
                                    <small class="text-muted">{{ $review->user->email }}</small>
                                </td>
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
                                        <a href="{{ route('admin.reviews.show', $review) }}" 
                                           class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @if(!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-soft-success" title="Setujui">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.reviews.reject', $review) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-soft-warning" title="Tolak">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" 
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
                    <p class="text-muted">Pelanggan belum memberikan review apapun</p>
                </div>
            @endif
        </div>
    </div>
</div>
<style>
    .badge-soft-warning {
        background-color: rgba(255, 249, 126, 0.96);
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

    .btn-soft-success {
        background-color: rgba(149, 255, 173, 1);
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
