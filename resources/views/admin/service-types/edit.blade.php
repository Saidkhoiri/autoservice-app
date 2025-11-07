@extends('layouts.app')

@section('title', 'Edit Jenis Layanan')

@section('content')
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
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Edit Jenis Layanan</h1>
            <p class="text-muted">Edit layanan: {{ $serviceType->name }}</p>
        </div>
        <a href="{{ route('admin.service-types.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Layanan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.service-types.update', $serviceType) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $serviceType->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $serviceType->price) }}" min="0" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="duration_minutes" class="form-label">Durasi (menit) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                           id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', $serviceType->duration_minutes) }}" min="1" required>
                                    @error('duration_minutes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $serviceType->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Layanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Service Preview -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Preview Layanan</h5>
                </div>
                <div class="card-body" id="service-preview">
                    <div class="text-center mb-3">
                        <i class="fas fa-cogs fa-2x text-primary"></i>
                    </div>
                    <h6 class="font-weight-bold text-center">{{ $serviceType->name }}</h6>
                    <p class="text-muted small mb-3">{{ $serviceType->description }}</p>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Durasi:</span>
                        <span class="font-weight-bold">{{ $serviceType->duration_minutes }} menit</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Harga:</span>
                        <span class="font-weight-bold text-primary">Rp {{ number_format($serviceType->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Current Status -->
            <div class="card shadow mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Status Saat Ini</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Status:</span>
                        @if($serviceType->is_active)
                            <span class="badge badge-soft-success">Aktif</span>
                        @else
                            <span class="badge badge-soft-secondary">Nonaktif</span>
                        @endif
                    </div>
                    
                    <div class="mt-3">
                        <form action="{{ route('admin.service-types.toggle', $serviceType) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $serviceType->is_active ? 'secondary' : 'success' }} w-100">
                                <i class="fas fa-{{ $serviceType->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $serviceType->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const durationInput = document.getElementById('duration_minutes');
    const descriptionInput = document.getElementById('description');
    const preview = document.getElementById('service-preview');
    
    function updatePreview() {
        const name = nameInput.value;
        const price = priceInput.value;
        const duration = durationInput.value;
        const description = descriptionInput.value;
        
        if (name && price && duration && description) {
            preview.innerHTML = `
                <div class="text-center mb-3">
                    <i class="fas fa-cogs fa-2x text-primary"></i>
                </div>
                <h6 class="font-weight-bold text-center">${name}</h6>
                <p class="text-muted small mb-3">${description}</p>
                <div class="d-flex justify-content-between mb-2">
                    <span>Durasi:</span>
                    <span class="font-weight-bold">${duration} menit</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Harga:</span>
                    <span class="font-weight-bold text-primary">Rp ${parseInt(price).toLocaleString('id-ID')}</span>
                </div>
            `;
        }
    }
    
    // Event listeners
    nameInput.addEventListener('input', updatePreview);
    priceInput.addEventListener('input', updatePreview);
    durationInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
});
</script>
@endpush
