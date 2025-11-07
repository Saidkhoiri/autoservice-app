@extends('layouts.app')

@section('title', 'Beri Review')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Beri Review</h1>
            <p class="text-muted">Review untuk Booking #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
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
                    <h5 class="mb-0">Form Review</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.reviews.store', $booking) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="rating-input" required>
                                    <label for="star{{ $i }}" class="rating-star">
                                        <i class="far fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="form-label">Komentar</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" 
                                      id="comment" name="comment" rows="4" 
                                      placeholder="Bagikan pengalaman Anda dengan layanan kami...">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Booking Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Booking</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="font-weight-bold">No. Booking:</h6>
                        <p class="mb-1">#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Layanan:</h6>
                        <p class="mb-1">{{ $booking->serviceType->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Tanggal Booking:</h6>
                        <p class="mb-1">{{ $booking->booking_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Kendaraan:</h6>
                        <p class="mb-1">{{ $booking->vehicle_number }}</p>
                        <p class="mb-1">{{ $booking->vehicle_brand }} {{ $booking->vehicle_model }}</p>
                    </div>
                    @if($booking->technician)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Teknisi:</h6>
                        <p class="mb-1">{{ $booking->technician->name }}</p>
                    </div>
                    @endif
                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Total:</span>
                            <span class="font-weight-bold text-primary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Guidelines -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Panduan Review</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Rating:</h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-star text-warning"></i> 5 - Sangat Puas</li>
                            <li><i class="fas fa-star text-warning"></i> 4 - Puas</li>
                            <li><i class="fas fa-star text-warning"></i> 3 - Cukup</li>
                            <li><i class="fas fa-star text-warning"></i> 2 - Kurang Puas</li>
                            <li><i class="fas fa-star text-warning"></i> 1 - Tidak Puas</li>
                        </ul>
                    </div>
                    <div class="mb-0">
                        <h6 class="font-weight-bold">Tips:</h6>
                        <ul class="list-unstyled small">
                            <li>• Berikan rating yang objektif</li>
                            <li>• Komentar bersifat opsional</li>
                            <li>• Review akan ditinjau admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.rating-stars {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}

.rating-input {
    display: none;
}

.rating-star {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}

.rating-star:hover,
.rating-star:hover ~ .rating-star,
.rating-input:checked ~ .rating-star {
    color: #ffc107;
}

.rating-star i {
    transition: transform 0.1s;
}

.rating-star:hover i,
.rating-star:hover ~ .rating-star i,
.rating-input:checked ~ .rating-star i {
    transform: scale(1.1);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const inputs = document.querySelectorAll('.rating-input');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            // tandai input yang sesuai
            inputs[index].checked = true;
            updateStars(index);
        });
    });

    function updateStars(activeIndex) {
        stars.forEach((star, i) => {
            const icon = star.querySelector('i');
            if (i <= activeIndex) {
                icon.className = 'fas fa-star';
                star.style.color = '#ffc107';
            } else {
                icon.className = 'far fa-star';
                star.style.color = '#ddd';
            }
        });
    }
});

</script>
@endpush
