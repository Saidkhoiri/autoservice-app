@extends('layouts.app')

@section('title', 'Kelola Teknisi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Kelola Teknisi</h1>
            <p class="text-muted">Daftar semua teknisi yang tersedia</p>
        </div>
        <a href="{{ route('admin.technicians.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Tambah Teknisi
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Daftar Teknisi</h5>
        </div>
        <div class="card-body">
            @if($technicians->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Spesialisasi</th>
                                <th>Status</th>
                                <th>Total Booking</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($technicians as $index => $technician)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="font-weight-bold">{{ $technician->name }}</div>
                                </td>
                                <td>
                                    <div>{{ $technician->phone }}</div>
                                </td>
                                <td>
                                    @if($technician->specialization)
                                        <div class="text-muted">{{ $technician->specialization }}</div>
                                    @else
                                        <span class="text-muted">Tidak ada spesialisasi</span>
                                    @endif
                                </td>
                                <td>
                                    @if($technician->is_active)
                                        <span class="badge badge-soft-success">Aktif</span>
                                    @else
                                        <span class="badge badge-soft-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $technician->bookings->count() }}</div>
                                </td>
                                <td>
                                    <div class="btn-action">
                                        <a href="{{ route('admin.technicians.show', $technician) }}" 
                                           class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.technicians.edit', $technician) }}" 
                                           class="btn btn-sm btn-soft-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.technicians.toggle', $technician) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-toggle {{ $technician->is_active ? 'active' : 'inactive' }}"
                                                    title="{{ $technician->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="fas fa-{{ $technician->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        
                                        @if($technician->bookings->count() == 0)
                                            <form action="{{ route('admin.technicians.destroy', $technician) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus teknisi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-danger" disabled title="Tidak dapat dihapus karena sudah ada booking">
                                                <i class="fas fa-trash"></i>
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
                    <i class="fas fa-user-cog fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum ada teknisi</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan teknisi pertama</p>
                    <a href="{{ route('admin.technicians.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Teknisi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<style>
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
    .btn-toggle.active {
    background-color: rgba(100, 100, 100, 0.25);
        color: #252525ff;
        font-weight: 600;
        border: 1px solid rgba(73, 73, 73, 0.4);
    }

    .btn-toggle.inactive {
        background-color: rgba(86, 255, 125, 0.59);
        color: #155724;
        font-weight: 600;
        border: 1px solid rgba(40, 167, 69, 0.4);
    }

    .btn-toggle:hover {
        opacity: 0.9;
        transform: scale(1.05);
        transition: all 0.2s ease;
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
