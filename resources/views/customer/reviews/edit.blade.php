@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Edit Review</h1>
            <p class="text-muted">Review untuk Booking #{{ str_pad($review->booking->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <a href="{{ route('customer.reviews.show', $review) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Review</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.reviews.update', $review) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" 
                                           class="rating-input" {{ old('rating', $review->rating) == $i ? 'checked' : '' }} required>
                                    <label for="star{{ $i }}" class="rating-star">
                                        <i class="{{ old('rating', $review->rating) >= $i ? 'fas' : 'far' }} fa-star"></i>
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
                                      placeholder="Bagikan pengalaman Anda dengan layanan kami...">{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Update Review
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
                        <p class="mb-1">#{{ str_pad($review->booking->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Layanan:</h6>
                        <p class="mb-1">{{ $review->booking->serviceType->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Tanggal Booking:</h6>
                        <p class="mb-1">{{ $review->booking->booking_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Kendaraan:</h6>
                        <p class="mb-1">{{ $review->booking->vehicle_number }}</p>
                        <p class="mb-1">{{ $review->booking->vehicle_brand }} {{ $review->booking->vehicle_model }}</p>
                    </div>
                    @if($review->booking->technician)
                    <div class="mb-3">
                        <h6 class="font-weight-bold">Teknisi:</h6>
                        <p class="mb-1">{{ $review->booking->technician->name }}</p>
                    </div>
                    @endif
                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Total:</span>
                            <span class="font-weight-bold text-primary">Rp {{ number_format($review->booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Review -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Review Saat Ini</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-muted"></i>
                            @endif
                        @endfor
                    </div>
                    
                    @if($review->comment)
                        <p class="text-muted">{{ $review->comment }}</p>
                    @else
                        <p class="text-muted">Tidak ada komentar</p>
                    @endif
                    
                    <small class="text-muted">
                        Diberikan pada {{ $review->created_at->format('d/m/Y H:i') }}
                    </small>
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
