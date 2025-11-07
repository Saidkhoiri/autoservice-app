<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ServiceType;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isCustomer()) {
            $bookings = $user->bookings()->with(['serviceType', 'technician'])->latest()->get();
            return view('customer.bookings.index', compact('bookings'));
        } else {
            $bookings = Booking::with(['user', 'serviceType', 'technician'])->latest()->get();
            return view('admin.bookings.index', compact('bookings'));
        }
    }

    public function create()
    {
        $serviceTypes = ServiceType::active()->get();
        return view('customer.bookings.create', compact('serviceTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_type_id' => 'required|exists:service_types,id',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required|date_format:H:i',
            'vehicle_number' => 'required|string|max:20',
            'vehicle_brand' => 'required|string|max:100',
            'vehicle_model' => 'required|string|max:100',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $serviceType = ServiceType::find($request->service_type_id);
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'service_type_id' => $request->service_type_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_brand' => $request->vehicle_brand,
            'vehicle_model' => $request->vehicle_model,
            'notes' => $request->notes,
            'total_price' => $serviceType->price,
        ]);

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking berhasil dibuat.');
    }

    public function show(Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user can view this booking
        if ($user->isCustomer() && $booking->user_id !== $user->id) {
            abort(403);
        }
        
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user can edit this booking
        if ($user->isCustomer() && $booking->user_id !== $user->id) {
            abort(403);
        }
        
        $serviceTypes = ServiceType::active()->get();
        $technicians = Technician::active()->get();
        
        return view('bookings.edit', compact('booking', 'serviceTypes', 'technicians'));
    }

   public function update(Request $request, Booking $booking)
{
    $user = Auth::user();
    
    if ($user->isCustomer() && $booking->user_id !== $user->id) {
        abort(403);
    }
    
    $rules = [
        'service_type_id' => 'required|exists:service_types,id',
        'booking_date' => 'required|date',
        'booking_time' => 'required|date_format:H:i',
        'vehicle_number' => 'required|string|max:20',
        'vehicle_brand' => 'required|string|max:100',
        'vehicle_model' => 'required|string|max:100',
        'notes' => 'nullable|string',
    ];
    
    if ($user->isAdminOrOwner()) {
        $rules['technician_id'] = 'nullable|exists:technicians,id';
        $rules['status'] = 'required|in:pending,confirmed,in_progress,completed,cancelled';
    }
    
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $updateData = [
        'service_type_id' => $request->service_type_id,
        'booking_date' => $request->booking_date,
        'booking_time' => $request->booking_time,
        'vehicle_number' => $request->vehicle_number,
        'vehicle_brand' => $request->vehicle_brand,
        'vehicle_model' => $request->vehicle_model,
        'notes' => $request->notes,
    ];
    
    if ($user->isAdminOrOwner()) {
        $updateData['technician_id'] = $request->technician_id;
        $updateData['status'] = $request->status;
    }
    
    $booking->update($updateData);

    if ($user->isAdminOrOwner()) {
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diperbarui!');
    } else {
        return redirect()->back()
            ->with('success', 'Booking berhasil diperbarui!');
    }
}

    public function destroy(Booking $booking)
    {
        $user = Auth::user();
        
        if ($user->isCustomer() && $booking->user_id !== $user->id) {
            abort(403);
        }
        
        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.index')
                ->with('error', 'Hanya booking dengan status pending yang dapat dihapus.');
        }

        $booking->delete();

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $user = Auth::user();
        
        if (!$user->isAdminOrOwner()) {
            abort(403);
        }
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'technician_id' => 'nullable|exists:technicians,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $booking->update([
            'status' => $request->status,
            'technician_id' => $request->technician_id,
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }
}
