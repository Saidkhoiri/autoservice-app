@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Edit Booking</h1>
            <p class="text-muted">Booking #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('bookings.show', $booking) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Booking</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.update', $booking) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
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
                                                    {{ old('service_type_id', $booking->service_type_id) == $service->id ? 'selected' : '' }}>
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
                                           value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" required>
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
                                           value="{{ old('booking_time', $booking->booking_time) }}" required>
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
                                           value="{{ old('vehicle_number', $booking->vehicle_number) }}" required>
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
                                           value="{{ old('vehicle_brand', $booking->vehicle_brand) }}" required>
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
                                           value="{{ old('vehicle_model', $booking->vehicle_model) }}" required>
                                    @error('vehicle_model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->isAdminOrOwner())
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="technician_id" class="form-label">Teknisi</label>
                                    <select class="form-select @error('technician_id') is-invalid @enderror" 
                                            id="technician_id" name="technician_id">
                                        <option value="">Pilih teknisi</option>
                                        @foreach($technicians as $technician)
                                            <option value="{{ $technician->id }}" 
                                                    {{ old('technician_id', $booking->technician_id) == $technician->id ? 'selected' : '' }}>
                                                {{ $technician->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('technician_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                        <option value="in_progress" {{ old('status', $booking->status) == 'in_progress' ? 'selected' : '' }}>Sedang Diproses</option>
                                        <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes', $booking->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Booking Summary -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Booking</h5>
                </div>
                <div class="card-body" id="booking-summary">
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Layanan</h6>
                        <p class="mb-1">{{ $booking->serviceType->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Jadwal</h6>
                        <p class="mb-1">{{ $booking->booking_date->format('d/m/Y') }}</p>
                        <p class="mb-1">{{ $booking->booking_time }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Kendaraan</h6>
                        <p class="mb-1">{{ $booking->vehicle_number }}</p>
                        <p class="mb-1">{{ $booking->vehicle_brand }} {{ $booking->vehicle_model }}</p>
                    </div>
                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Total:</span>
                            <span class="font-weight-bold text-primary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
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
    const bookingSummary = document.getElementById('booking-summary');
    
    function updateBookingSummary() {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        if (selectedOption.value) {
            const price = selectedOption.dataset.price;
            const name = selectedOption.text.split(' - ')[0];
            
            bookingSummary.innerHTML = `
                <div class="mb-3">
                    <h6 class="font-weight-bold">Layanan</h6>
                    <p class="mb-1">${name}</p>
                </div>
                <div class="mb-3">
                    <h6 class="font-weight-bold">Jadwal</h6>
                    <p class="mb-1">{{ $booking->booking_date->format('d/m/Y') }}</p>
                    <p class="mb-1">{{ $booking->booking_time }}</p>
                </div>
                <div class="mb-3">
                    <h6 class="font-weight-bold">Kendaraan</h6>
                    <p class="mb-1">{{ $booking->vehicle_number }}</p>
                    <p class="mb-1">{{ $booking->vehicle_brand }} {{ $booking->vehicle_model }}</p>
                </div>
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Total:</span>
                        <span class="font-weight-bold text-primary">Rp ${parseInt(price).toLocaleString('id-ID')}</span>
                    </div>
                </div>
            `;
        }
    }
    
    // Event listeners
    serviceSelect.addEventListener('change', updateBookingSummary);
});
</script>
@endpush
