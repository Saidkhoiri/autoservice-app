@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<style>
    .info-box {
        border: 1.5px solid #d3bdfcff;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 15px;
        background-color: #faf8ff;
    }
    .info-box label {
        color: #6f42c1;
        font-weight: 600;
    }
    .info-box .icon {
        color: #6f42c1;
    }
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
      .badge-soft-success {
        background-color: rgba(86, 255, 125, 0.59);
        color: #155724;
        font-weight: 600;
        border: 1px solid rgba(40, 167, 69, 0.4);
    }

     .badge-soft-successs {
       background-color: rgba(40, 167, 69, 0.25);
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
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Detail User</h1>
            <p class="text-muted">Informasi lengkap user</p>
        </div>
        <div>
            <a href="{{ route('owner.users.edit', $user) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('owner.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- CARD INFORMASI USER -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Informasi User</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm"
                             style="width: 90px; height: 90px; background: linear-gradient(135deg, #6366F1, #818CF8);">
                            <i class="fas fa-user fa-2x text-white"></i>
                        </div>
                    </div>

                    <!-- Setiap data user dibungkus dalam info-box -->
                    <div class="info-box">
                        <label>Nama</label>
                        <div class="h5">{{ $user->name }}</div>
                    </div>

                    <div class="info-box">
                        <label>Email</label>
                        <div><i class="fas fa-envelope me-2 icon"></i>{{ $user->email }}</div>
                    </div>

                    <div class="info-box">
                        <label>Nomor Telepon</label>
                        <div>
                            @if($user->phone)
                                <i class="fas fa-phone me-2 icon"></i>{{ $user->phone }}
                            @else
                                <span class="text-muted">Tidak ada nomor telepon</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-box">
                        <label>Alamat</label>
                        <div>
                            @if($user->address)
                                <i class="fas fa-map-marker-alt me-2 icon"></i>{{ $user->address }}
                            @else
                                <span class="text-muted">Tidak ada alamat</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-box">
                        <label>Role</label>
                        <div>
                            @if($user->role)
                                <span class="badge bg-{{ $user->role->name == 'customer' ? 'primary' : ($user->role->name == 'admin' ? 'warning' : 'danger') }}">
                                    {{ $user->role->display_name }}
                                </span>
                                <div class="text-muted small mt-1">{{ $user->role->description }}</div>
                            @else
                                <span class="badge bg-secondary">Tidak ada role</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-box">
                        <label>Status</label>
                        <div>
                            @if($user->is_active)
                                <span class="badge badge-soft-success">Aktif</span>
                            @else
                                <span class="badge badge-soft-secondary">Nonaktif</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-box">
                        <label>Tanggal Terdaftar</label>
                        <div><i class="fas fa-calendar me-2 icon"></i>{{ $user->created_at->format('d M Y H:i') }}</div>
                    </div>

                    <div class="info-box">
                        <label>Terakhir Diupdate</label>
                        <div><i class="fas fa-clock me-2 icon"></i>{{ $user->updated_at->format('d M Y H:i') }}</div>
                    </div>
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
                                <div class="h2 text-primary">{{ $user->bookings->count() }}</div>
                                <div class="text-muted">Total Booking</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-warning">{{ $user->bookings->where('status', 'pending')->count() }}</div>
                                <div class="text-muted">Pending</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-info">{{ $user->bookings->where('status', 'confirmed')->count() }}</div>
                                <div class="text-muted">Dikonfirmasi</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="h2 text-success">{{ $user->bookings->where('status', 'completed')->count() }}</div>
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
                    @if($user->bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->bookings->sortByDesc('created_at')->take(10) as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
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
                                            <a href="{{ route('owner.bookings.show', $booking) }}" 
                                               class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if($user->bookings->count() > 10)
                            <div class="text-center mt-3">
                                <a href="{{ route('owner.bookings.index') }}?user_id={{ $user->id }}" 
                                   class="btn btn-outline-primary">
                                    Lihat Semua Booking
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada booking</h5>
                            <p class="text-muted">User ini belum pernah melakukan booking</p>
                        </div>
                    @endif
                </div>
            </div>
            
            @if($user->reviews->count() > 0)
            <div class="card shadow mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Review</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Booking</th>
                                    <th>Rating</th>
                                    <th>Komentar</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->reviews->sortByDesc('created_at')->take(5) as $index => $review)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="font-weight-bold">{{ $review->booking->serviceType->name }}</div>
                                        <small class="text-muted">{{ $review->booking->booking_date->format('d M Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ Str::limit($review->comment, 50) }}</div>
                                    </td>
                                    <td>
                                        @if($review->is_approved)
                                            <span class="badge badge-soft-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-soft-warning">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $review->created_at->format('d M Y') }}</div>
                                        <small class="text-muted">{{ $review->created_at->format('H:i') }}</small>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection