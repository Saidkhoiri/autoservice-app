<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ServiceType;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function customerDashboard()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with(['serviceType', 'technician'])->latest()->get();
        $serviceTypes = ServiceType::active()->get();
        
        return view('customer.dashboard', compact('bookings', 'serviceTypes'));
    }

    public function adminDashboard()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::pending()->count();
        $confirmedBookings = Booking::confirmed()->count();
        $completedBookings = Booking::completed()->count();
        
        $recentBookings = Booking::with(['user', 'serviceType', 'technician'])
            ->latest()
            ->take(10)
            ->get();
            
        $technicians = Technician::active()->get();
        $serviceTypes = ServiceType::active()->get();
        
        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'completedBookings',
            'recentBookings',
            'technicians',
            'serviceTypes'
        ));
    }

    public function ownerDashboard()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::pending()->count();
        $confirmedBookings = Booking::confirmed()->count();
        $completedBookings = Booking::completed()->count();
        
        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $monthlyRevenue = Booking::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');
            
        $recentBookings = Booking::with(['user', 'serviceType', 'technician'])
            ->latest()
            ->take(10)
            ->get();
            
        $totalUsers = User::count();
        $totalTechnicians = Technician::count();
        $totalServices = ServiceType::count();

        $monthlyLabels = [];
        $monthlyData = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = Carbon::create()->month($i)->translatedFormat('F');
            $monthlyData[] = Booking::where('status', 'completed')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->sum('total_price');
        }
        
        return view('owner.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'completedBookings',
            'totalRevenue',
            'monthlyRevenue',
            'recentBookings',
            'totalUsers',
            'totalTechnicians',
            'totalServices',
            'monthlyLabels',
            'monthlyData'   
        ));
    }
}
