<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isCustomer()) {
            $reviews = $user->reviews()->with(['booking.serviceType'])->latest()->get();
            return view('customer.reviews.index', compact('reviews'));
        } else {
            $reviews = Review::with(['user', 'booking.serviceType'])->latest()->get();
            return view('admin.reviews.index', compact('reviews'));
        }
    }

    public function create(Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user can review this booking
        if ($booking->user_id !== $user->id) {
            abort(403);
        }
        
        // Check if booking is completed
        if ($booking->status !== 'completed') {
            return redirect()->route('bookings.index')
                ->with('error', 'Hanya booking yang sudah selesai yang dapat direview.');
        }
        
        // Check if review already exists
        if ($booking->review) {
            return redirect()->route('bookings.index')
                ->with('error', 'Booking ini sudah direview.');
        }
        
        return view('customer.reviews.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $user = Auth::user();

        if ($booking->user_id !== $user->id) {
            abort(403);
        }

        if ($booking->status !== 'completed') {
            return redirect()->route('bookings.index')
                ->with('error', 'Hanya booking yang sudah selesai yang dapat direview.');
        }

        if ($booking->review) {
            return redirect()->route('bookings.index')
                ->with('error', 'Booking ini sudah direview.');
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        if ($user->isCustomer()) {
            return redirect()->route('customer.reviews.index')
                ->with('success', 'Review berhasil dikirim dan menunggu persetujuan admin.');
        }

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil ditambahkan dan menunggu persetujuan admin.');
    }

    public function show(Review $review)
    {
        $user = Auth::user();
        
        // Check if user can view this review
        if ($user->isCustomer() && $review->user_id !== $user->id) {
            abort(403);
        }
        
        return view('reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $user = Auth::user();
        
        // Check if user can edit this review
        if ($review->user_id !== $user->id) {
            abort(403);
        }
        
        return view('customer.reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $user = Auth::user();
        
        // Check if user can update this review
        if ($review->user_id !== $user->id) {
            abort(403);
        }
        
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false, // Reset approval status when updated
        ]);

          if ($user->isCustomer()) {
        return redirect()->route('customer.reviews.index')
            ->with('success', 'Review berhasil diperbarui dan menunggu persetujuan admin.');
        }

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil diperbarui dan menunggu persetujuan admin.');
    }

   public function destroy(Review $review)
    {
        $user = Auth::user();
        
        // Hanya pemilik review (customer) atau admin yang boleh hapus
        if ($user->isCustomer() && $review->user_id !== $user->id) {
            abort(403);
        }

        $review->delete();

        if ($user->isAdminOrOwner()) {
            return redirect()->route('admin.reviews.index')
                ->with('success', 'Review berhasil dihapus.');
        }

        return redirect()->route('customer.reviews.index')
            ->with('success', 'Review berhasil dihapus.');
    }

    public function approve(Review $review)
    {
        $user = Auth::user();
        
        if (!$user->isAdminOrOwner()) {
            abort(403);
        }
        
        $review->update(['is_approved' => true]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil disetujui.');
    }

    public function reject(Review $review)
    {
        $user = Auth::user();
        
        if (!$user->isAdminOrOwner()) {
            abort(403);
        }
        
        $review->update(['is_approved' => false]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil ditolak.');
    }
}
