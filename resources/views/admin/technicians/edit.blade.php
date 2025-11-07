@extends('layouts.app')

@section('title', 'Edit Teknisi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Edit Teknisi</h1>
            <p class="text-muted">Edit informasi teknisi</p>
        </div>
        <a href="{{ route('admin.technicians.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Teknisi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.technicians.update', $technician) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Teknisi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $technician->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $technician->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="specialization" class="form-label">Spesialisasi</label>
                            <textarea class="form-control @error('specialization') is-invalid @enderror" 
                                      id="specialization" name="specialization" rows="3" 
                                      placeholder="Contoh: Spesialis mesin, transmisi, kelistrikan, dll.">{{ old('specialization', $technician->specialization) }}</textarea>
                            @error('specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Opsional. Jelaskan keahlian atau spesialisasi teknisi</div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $technician->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Teknisi Aktif
                                </label>
                            </div>
                            <div class="form-text">Teknisi aktif dapat ditugaskan untuk booking</div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Teknisi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Teknisi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Saat Ini</label>
                        <div>
                            @if($technician->is_active)
                                <span class="badge badge-soft-success">Aktif</span>
                            @else
                                <span class="badge badge-soft-secondary">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Total Booking</label>
                        <div class="h4 text-primary">{{ $technician->bookings->count() }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Dibuat</label>
                        <div>{{ $technician->created_at->format('d M Y H:i') }}</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir Diupdate</label>
                        <div>{{ $technician->updated_at->format('d M Y H:i') }}</div>
                    </div>
                    
                    @if($technician->bookings->count() > 0)
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                            <p class="mb-0">Teknisi ini memiliki {{ $technician->bookings->count() }} booking, tidak dapat dihapus</p>
                        </div>
                    @endif
                </div>
            </div>
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
    </style>
@endsection
