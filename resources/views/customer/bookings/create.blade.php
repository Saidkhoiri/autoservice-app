@extends('layouts.app')

@section('title', 'Buat Booking Baru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Buat Booking Baru</h1>
            <p class="text-muted">Pilih layanan dan jadwal yang diinginkan</p>
        </div>
        <a href="{{ route('customer.bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Form Booking</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.bookings.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="service_type_id" class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('service_type_id') is-invalid @enderror" 
                                            id="service_type_id" name="service_type_id" required>
                                        <option value="">Pilih layanan</option>
                                        @foreach($serviceTypes as $service)
                                            <option value="{{ $service->id }}" 
                                                    data-price="{{ $service->price }}"
                                                    data-duration="{{ $service->duration_minutes }}"
                                                    {{ old('service_type_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="booking_date" class="form-label">Tanggal Booking <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('booking_date') is-invalid @enderror" 
                                           id="booking_date" name="booking_date" 
                                           value="{{ old('booking_date') }}" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    @error('booking_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="booking_time" class="form-label">Waktu Booking <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('booking_time') is-invalid @enderror" 
                                           id="booking_time" name="booking_time" 
                                           value="{{ old('booking_time') }}" required>
                                    <small class="form-text text-muted">Jam operasional: 08:00 - 17:00</small>
                                    @error('booking_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vehicle_number" class="form-label">Nomor Kendaraan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vehicle_number') is-invalid @enderror" 
                                           id="vehicle_number" name="vehicle_number" 
                                           value="{{ old('vehicle_number') }}" 
                                           placeholder="Contoh: B 1234 ABC" required>
                                    @error('vehicle_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vehicle_brand" class="form-label">Merek Kendaraan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vehicle_brand') is-invalid @enderror" 
                                           id="vehicle_brand" name="vehicle_brand" 
                                           value="{{ old('vehicle_brand') }}" 
                                           placeholder="Contoh: Honda, Toyota, Suzuki" required>
                                    @error('vehicle_brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vehicle_model" class="form-label">Model Kendaraan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vehicle_model') is-invalid @enderror" 
                                           id="vehicle_model" name="vehicle_model" 
                                           value="{{ old('vehicle_model') }}" 
                                           placeholder="Contoh: Brio, Avanza, Ertiga" required>
                                    @error('vehicle_model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3" 
                                      placeholder="Tambahkan catatan khusus jika ada">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Buat Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Service Details -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Layanan</h5>
                </div>
                <div class="card-body" id="service-details">
                    <div class="text-center text-muted">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>Pilih layanan untuk melihat detail</p>
                    </div>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Booking</h5>
                </div>
                <div class="card-body" id="booking-summary">
                    <div class="text-center text-muted">
                        <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                        <p>Lengkapi form untuk melihat ringkasan</p>
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
    const serviceSelect = document.getElementById('service_type_id');
    const serviceDetails = document.getElementById('service-details');
    const bookingSummary = document.getElementById('booking-summary');
    
    function updateServiceDetails() {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        if (selectedOption.value) {
            const price = selectedOption.dataset.price;
            const duration = selectedOption.dataset.duration;
            const name = selectedOption.text.split(' - ')[0];
            
            serviceDetails.innerHTML = `
                <h6 class="font-weight-bold">${name}</h6>
                <p class="text-muted small mb-3">${selectedOption.text.split(' - ')[1]}</p>
                <div class="d-flex justify-content-between mb-2">
                    <span>Durasi:</span>
                    <span class="font-weight-bold">${duration} menit</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Harga:</span>
                    <span class="font-weight-bold text-primary">Rp ${parseInt(price).toLocaleString('id-ID')}</span>
                </div>
            `;
        } else {
            serviceDetails.innerHTML = `
                <div class="text-center text-muted">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <p>Pilih layanan untuk melihat detail</p>
                </div>
            `;
        }
    }
    
    function updateBookingSummary() {
        const serviceSelect = document.getElementById('service_type_id');
        const dateInput = document.getElementById('booking_date');
        const timeInput = document.getElementById('booking_time');
        const vehicleNumber = document.getElementById('vehicle_number').value;
        const vehicleBrand = document.getElementById('vehicle_brand').value;
        const vehicleModel = document.getElementById('vehicle_model').value;
        
        if (serviceSelect.value && dateInput.value && timeInput.value) {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const price = selectedOption.dataset.price;
            const name = selectedOption.text.split(' - ')[0];
            
            const date = new Date(dateInput.value);
            const formattedDate = date.toLocaleDateString('id-ID', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            bookingSummary.innerHTML = `
                <div class="mb-3">
                    <h6 class="font-weight-bold">Layanan</h6>
                    <p class="mb-1">${name}</p>
                </div>
                <div class="mb-3">
                    <h6 class="font-weight-bold">Jadwal</h6>
                    <p class="mb-1">${formattedDate}</p>
                    <p class="mb-1">${timeInput.value}</p>
                </div>
                ${vehicleNumber ? `
                <div class="mb-3">
                    <h6 class="font-weight-bold">Kendaraan</h6>
                    <p class="mb-1">${vehicleNumber}</p>
                    <p class="mb-1">${vehicleBrand} ${vehicleModel}</p>
                </div>
                ` : ''}
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Total:</span>
                        <span class="font-weight-bold text-primary">Rp ${parseInt(price).toLocaleString('id-ID')}</span>
                    </div>
                </div>
            `;
        } else {
            bookingSummary.innerHTML = `
                <div class="text-center text-muted">
                    <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                    <p>Lengkapi form untuk melihat ringkasan</p>
                </div>
            `;
        }
    }
    
    // Event listeners
    serviceSelect.addEventListener('change', function() {
        updateServiceDetails();
        updateBookingSummary();
    });
    
    document.getElementById('booking_date').addEventListener('change', updateBookingSummary);
    document.getElementById('booking_time').addEventListener('change', updateBookingSummary);
    document.getElementById('vehicle_number').addEventListener('input', updateBookingSummary);
    document.getElementById('vehicle_brand').addEventListener('input', updateBookingSummary);
    document.getElementById('vehicle_model').addEventListener('input', updateBookingSummary);
    
    // Initialize
    updateServiceDetails();
    updateBookingSummary();
});
</script>
@endpush
<style>
    /* ===== Card Styling ===== */
    .card {
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background: linear-gradient(90deg, #e2e3ffff 0%, #ece5fdff 100%);
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        padding: 14px 20px;
    }

    .card-header h5 {
        font-weight: 600;
        color: #5f3d86ff;
        margin: 0;
    }

    .card-body {
        padding: 20px;
    }

    /* ===== Form Styling ===== */
    .form-label {
        font-weight: 600;
        color: #444;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    textarea.form-control {
        resize: none;
    }

    /* ===== Button Style ===== */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0056b3);
        border: none;
        border-radius: 8px;
        transition: all 0.25s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7, #0049a1);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .btn-secondary {
        border-radius: 8px;
        background: #6c757d;
        border: none;
        transition: 0.2s ease;
    }

    .btn-secondary:hover {
        background: #5c636a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.25);
    }

    /* ===== Side Card (Detail Layanan & Ringkasan) ===== */
    #service-details, #booking-summary {
        border-radius: 8px;
        background: #f9fafc;
        min-height: 160px;
        transition: background 0.3s ease-in-out;
    }

    #service-details:hover, #booking-summary:hover {
        background: #f1f3f6;
    }

    #service-details h6, #booking-summary h6 {
        color: #7967c7ff;
        font-weight: 600;
    }

    /* ===== Icon Style ===== */
    .text-muted i {
        opacity: 0.7;
    }

    /* ===== Responsive Adjustment ===== */
    @media (max-width: 768px) {
        .card-body {
            padding: 15px;
        }
    }
</style>
