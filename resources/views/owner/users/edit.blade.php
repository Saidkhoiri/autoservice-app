@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<style>
    .info-box {
        border: 1.5px solid #d6d6d6ff;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 15px;
        background-color: #faf8ff;
    }
    .info-box label {
        color: #505050ff;
        font-weight: 600;
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
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Edit User</h1>
            <p class="text-muted">Edit informasi user</p>
        </div>
        <a href="{{ route('owner.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <!-- FORM EDIT USER -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('owner.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-select @error('role_id') is-invalid @enderror" 
                                            id="role_id" name="role_id" required>
                                        <option value="">Pilih Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->display_name }} - {{ $role->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" 
                                      placeholder="Masukkan alamat lengkap">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- CARD INFORMASI USER -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Informasi User</h5>
                </div>
                <div class="card-body">
                    <div class="info-box">
                        <label>Status Saat Ini:</label>
                        <div class="value">
                            @if($user->is_active)
                                <span class="badge badge-soft-success">Aktif</span>
                            @else
                                <span class="badge badge-soft-secondary">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <label>Total Booking:</label>
                        <div class="h5 text-primary">{{ $user->bookings->count() }}</div>
                    </div>
                    
                    <div class="info-box">
                        <label>Tanggal Terdaftar:</label>
                        <div class="value">{{ $user->created_at->format('d M Y H:i') }}</div>
                    </div>
                    
                    <div class="info-box">
                        <label>Terakhir Diupdate:</label>
                        <div class="value">{{ $user->updated_at->format('d M Y H:i') }}</div>
                    </div>
                    
                    @if($user->bookings->count() > 0)
                        <div class="alert alert-warning mt-3">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                            <p class="mb-0">User ini memiliki {{ $user->bookings->count() }} booking, tidak dapat dihapus</p>
                        </div>
                    @endif
                    
                    @if($user->id == auth()->id())
                        <div class="alert alert-info mt-3">
                            <h6><i class="fas fa-info-circle me-2"></i>Info</h6>
                            <p class="mb-0">Anda sedang mengedit profil sendiri</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection