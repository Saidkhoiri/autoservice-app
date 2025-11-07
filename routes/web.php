<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('dashboard');
    
    // Services
    Route::get('/services', [ServiceTypeController::class, 'customerIndex'])->name('services.index');
    
    // Bookings
    Route::resource('bookings', BookingController::class);
    
    // Reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create/{booking}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{booking}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    
    // Service Types
    Route::resource('service-types', ServiceTypeController::class);
    Route::patch('/service-types/{serviceType}/toggle', [ServiceTypeController::class, 'toggleStatus'])->name('service-types.toggle');
    
    // Technicians
    Route::resource('technicians', TechnicianController::class);
    Route::patch('/technicians/{technician}/toggle', [TechnicianController::class, 'toggleStatus'])->name('technicians.toggle');
    
    // Bookings
    Route::resource('bookings', BookingController::class);
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    
    // Reviews
    Route::resource('reviews', ReviewController::class)->except(['create', 'store']);
    Route::patch('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
});

// Owner routes (includes all admin functionality plus additional features)
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'ownerDashboard'])->name('dashboard');
    
    // Service Types
    Route::resource('service-types', ServiceTypeController::class);
    Route::patch('/service-types/{serviceType}/toggle', [ServiceTypeController::class, 'toggleStatus'])->name('service-types.toggle');
    
    // Technicians
    Route::resource('technicians', TechnicianController::class);
    Route::patch('/technicians/{technician}/toggle', [TechnicianController::class, 'toggleStatus'])->name('technicians.toggle');
    
    // Bookings
    Route::resource('bookings', BookingController::class);
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
    
    // Reviews
    Route::resource('reviews', ReviewController::class)->except(['create', 'store']);
    Route::patch('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
    
    // User Management (Owner only)
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');
    
    // Reports & Analytics (Owner only)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports/revenue-data', [ReportController::class, 'getRevenueData'])->name('reports.revenue-data');
    Route::get('/reports/booking-trends', [ReportController::class, 'getBookingTrends'])->name('reports.booking-trends');
    Route::get('/reports/service-analytics', [ReportController::class, 'getServiceAnalytics'])->name('reports.service-analytics');
    Route::get('/reports/technician-analytics', [ReportController::class, 'getTechnicianAnalytics'])->name('reports.technician-analytics');
});

// Shared routes for authenticated users
Route::middleware('auth')->group(function () {
    // Redirect based on user role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->isOwner()) {
            return redirect()->route('owner.dashboard');
        } elseif ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('customer.dashboard');
        }
    })->name('dashboard');
    
    // Shared booking and review routes
    Route::resource('bookings', BookingController::class)->only(['show', 'edit', 'update', 'destroy']);
    Route::resource('reviews', ReviewController::class)->only(['show']);
});
