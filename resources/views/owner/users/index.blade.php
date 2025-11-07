@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Kelola User</h1>
            <p class="text-muted">Daftar semua user dalam sistem</p>
        </div>
        <a href="{{ route('owner.users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>
            Tambah User
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Daftar User</h5>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Total Booking</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="font-weight-bold">{{ $user->name }}</div>
                                </td>
                                <td>
                                    <div>{{ $user->email }}</div>
                                </td>
                                <td>
                                    @if($user->phone)
                                        <div>{{ $user->phone }}</div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->role)
                                        <span class="badge bg-{{ $user->role->name == 'customer' ? 'primary' : ($user->role->name == 'admin' ? 'warning' : 'danger') }}">
                                            {{ $user->role->display_name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Tidak ada role</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge badge-soft-success">Aktif</span>
                                    @else
                                        <span class="badge badge-soft-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $user->bookings->count() }}</div>
                                </td>
                                <td>
                                    <div>{{ $user->created_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-action">
                                        <a href="{{ route('owner.users.show', $user) }}" 
                                           class="btn btn-sm btn-soft-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('owner.users.edit', $user) }}" 
                                           class="btn btn-sm btn-soft-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        @if($user->id != auth()->id())
                                            <form action="{{ route('owner.users.toggle', $user) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                class="btn btn-sm btn-toggle {{ $user->is_active ? 'active' : 'inactive' }}" 
                                                        title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    <i class="fas fa-{{ $user->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            
                                            @if($user->bookings->count() == 0)
                                                <form action="{{ route('owner.users.destroy', $user) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-danger" disabled title="Tidak dapat dihapus karena sudah ada booking">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled title="Tidak dapat mengedit diri sendiri">
                                                <i class="fas fa-user"></i>
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
                    <i class="fas fa-users fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum ada user</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan user pertama</p>
                    <a href="{{ route('owner.users.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i>
                        Tambah User Pertama
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
        background-color: rgba(255, 255, 255, 0.15);
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
