@extends('layouts.app')

@section('title', 'Kelola Jenis Layanan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Kelola Jenis Layanan</h1>
            <p class="text-muted">Daftar semua jenis layanan yang tersedia</p>
        </div>
        <a href="{{ route('admin.service-types.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Tambah Layanan
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Daftar Jenis Layanan</h5>
        </div>
        <div class="card-body">
            @if($serviceTypes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($serviceTypes as $index => $service)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="font-weight-bold">{{ $service->name }}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{ Str::limit($service->description, 100) }}</div>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-primary">
                                        Rp {{ number_format($service->price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-soft-info">{{ $service->duration_minutes }} menit</span>
                                </td>
                                <td>
                                    @if($service->is_active)
                                        <span class="badge badge-soft-success">Aktif</span>
                                    @else
                                        <span class="badge badge-soft-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-action">
                                        <a href="{{ route('admin.service-types.show', $service) }}" 
                                           class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.service-types.edit', $service) }}" 
                                           class="btn btn-sm btn-soft-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.service-types.toggle', $service) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                           <button type="submit"
                                                class="btn btn-sm btn-toggle {{ $service->is_active ? 'active' : 'inactive' }}"
                                                title="{{ $service->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="fas fa-{{ $service->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.service-types.destroy', $service) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
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
                    <i class="fas fa-cogs fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum ada jenis layanan</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan jenis layanan pertama</p>
                    <a href="{{ route('admin.service-types.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Layanan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<style>
    .table td:first-child,
    .table th:first-child {
        text-align: center;
        vertical-align: middle;
        width: 60px; 
    }

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
     .badge-soft-info {
        background-color: rgba(173, 244, 255, 1);
        color: #055160;
        font-weight: 600;
        border: 1px solid rgba(23, 162, 184, 0.4);
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
