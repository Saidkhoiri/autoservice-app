@extends('layouts.app')

@section('title', 'Tambah Teknisi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Tambah Teknisi</h1>
            <p class="text-muted">Tambah teknisi baru ke sistem</p>
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
                    <h5 class="mb-0">Form Tambah Teknisi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.technicians.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Teknisi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
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
                                      placeholder="Contoh: Spesialis mesin, transmisi, kelistrikan, dll.">{{ old('specialization') }}</textarea>
                            @error('specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Opsional. Jelaskan keahlian atau spesialisasi teknisi</div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Teknisi Aktif
                                </label>
                            </div>
                            <div class="form-text">Teknisi aktif dapat ditugaskan untuk booking</div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Simpan Teknisi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>Tips</h6>
                        <ul class="mb-0">
                            <li>Pastikan nomor telepon valid untuk komunikasi</li>
                            <li>Spesialisasi membantu dalam penugasan booking</li>
                            <li>Teknisi nonaktif tidak akan muncul di pilihan booking</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                        <p class="mb-0">Teknisi yang sudah memiliki booking tidak dapat dihapus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
