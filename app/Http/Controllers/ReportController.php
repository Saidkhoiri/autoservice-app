<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\ServiceType;
use App\Models\Technician;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Get current date and month
        $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Summary statistics
        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalBookings = Booking::count();
        $totalCustomers = User::where('role_id', 1)->count(); // Customer role
        $averageRating = Review::where('is_approved', true)->avg('rating') ?? 0;

        // Today's statistics
        $todayBookings = Booking::whereDate('created_at', $currentDate)->count();
        $monthlyRevenue = Booking::where('status', 'completed')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total_price');
        $newCustomers = User::where('role_id', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $totalReviews = Review::count();
        $newReviews = Review::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        // Monthly revenue data for chart (last 12 months)
        $monthlyData = [];
        $monthlyLabels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $date->format('M Y');
            
            $revenue = Booking::where('status', 'completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_price');
            
            $monthlyData[] = $revenue;
        }

        // Booking status data for pie chart
        $bookingStatusData = [
            Booking::where('status', 'pending')->count(),
            Booking::where('status', 'confirmed')->count(),
            Booking::where('status', 'completed')->count(),
            Booking::where('status', 'cancelled')->count(),
        ];

        // Service performance data
        $servicePerformance = ServiceType::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->get();

        $serviceLabels = $servicePerformance->pluck('name')->toArray();
        $serviceData = $servicePerformance->pluck('bookings_count')->toArray();

        // Technician performance data
        $technicianPerformance = Technician::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get();

        $technicianLabels = $technicianPerformance->pluck('name')->toArray();
        $technicianData = $technicianPerformance->pluck('bookings_count')->toArray();

        // Recent bookings
        $recentBookings = Booking::with(['user', 'serviceType'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('owner.reports.index', compact(
            'totalRevenue',
            'totalBookings',
            'totalCustomers',
            'averageRating',
            'todayBookings',
            'monthlyRevenue',
            'newCustomers',
            'totalReviews',
            'newReviews',
            'monthlyData',
            'monthlyLabels',
            'bookingStatusData',
            'serviceLabels',
            'serviceData',
            'technicianLabels',
            'technicianData',
            'recentBookings'
        ));
    }

    public function export()
    {
        $currentDate = now()->format('d F Y');

        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalBookings = Booking::count();
        $totalCustomers = User::where('role_id', 1)->count(); // Customer role
        $averageRating = Review::where('is_approved', true)->avg('rating') ?? 0;

        $recentBookings = Booking::with(['user', 'serviceType'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // 🔹 Gunakan DomPDF untuk generate PDF
        $pdf = \PDF::loadView('owner.reports.pdf', [
            'date' => $currentDate,
            'totalRevenue' => $totalRevenue,
            'totalBookings' => $totalBookings,
            'totalCustomers' => $totalCustomers,
            'averageRating' => $averageRating,
            'recentBookings' => $recentBookings,
        ]);

        // 🔹 Kembalikan file PDF untuk diunduh
        return $pdf->download('laporan_owner_' . now()->format('Y_m_d_His') . '.pdf');
    }

    public function getRevenueData(Request $request)
    {
        $period = $request->get('period', 'monthly');
        
        if ($period === 'weekly') {
            // Get weekly data for last 12 weeks
            $data = [];
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
                $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
                
                $labels[] = 'Week ' . $startOfWeek->format('M d');
                
                $revenue = Booking::where('status', 'completed')
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->sum('total_price');
                
                $data[] = $revenue;
            }
        } else {
            // Monthly data (default)
            $data = [];
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->format('M Y');
                
                $revenue = Booking::where('status', 'completed')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->sum('total_price');
                
                $data[] = $revenue;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function getBookingTrends(Request $request)
    {
        $days = $request->get('days', 30);
        
        $data = [];
        $labels = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d');
            
            $bookings = Booking::whereDate('created_at', $date)->count();
            $data[] = $bookings;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function getServiceAnalytics()
    {
        $services = ServiceType::withCount(['bookings as total_bookings'])
            ->withSum(['bookings as total_revenue' => function($query) {
                $query->where('status', 'completed');
            }])
            ->get();

        return response()->json($services);
    }

    public function getTechnicianAnalytics()
    {
        $technicians = Technician::withCount(['bookings as total_bookings'])
            ->withAvg(['bookings as avg_rating' => function($query) {
                $query->whereHas('review');
            }])
            ->get();

        return response()->json($technicians);
    }
}
