@extends('layouts.app')

@section('title', 'Daftar Jasa')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Daftar Jasa</h1>
            <p class="text-muted">Pilih layanan yang Anda butuhkan</p>
        </div>
        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus me-2"></i>
            Buat Booking
        </a>
    </div>

    @if($serviceTypes->count() > 0)
        <div class="row">
            @foreach($serviceTypes as $service)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-tools fa-lg text-white"></i>
                            </div>
                            <div class="text-end">
                                <div class="h4 text-primary mb-0">Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                                <small class="text-muted">{{ $service->duration_minutes }} menit</small>
                            </div>
                        </div>
                        
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text text-muted">{{ $service->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if($service->is_active)
                                    <span class="badge badge-bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Tersedia</span>
                                @endif
                            </div>
                            <a href="{{ route('customer.bookings.create', ['service_id' => $service->id]) }}" 
                               class="btn btn-outline-primary btn-sm {{ !$service->is_active ? 'disabled' : '' }}">
                                <i class="fas fa-calendar-plus me-1"></i>
                                Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-tools fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">Belum ada jasa tersedia</h4>
            <p class="text-muted">Silakan hubungi admin untuk informasi lebih lanjut</p>
        </div>
    @endif
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-title {
    color: #2c3e50;
    font-weight: 600;
}

.bg-primary {
    background-color: #3498db !important;
}

.btn-outline-primary {
    border-color: #3498db;
    color: #3498db;
}

.btn-outline-primary:hover {
    background-color: #3498db;
    border-color: #3498db;
}
.badge-bg-success {
        background-color: rgba(31, 196, 70, 0.87);
        color: #ffffffff;
        font-weight: 600;
        border: 1px solid rgba(35, 128, 57, 0.4);
    }
</style>
@endsection
