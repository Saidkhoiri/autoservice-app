<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AutoServis - Bengkel Terpercaya')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #36b9cc;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Modern Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 280px;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-brand .brand-logo {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .sidebar-brand .brand-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .sidebar-brand .brand-subtitle {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 0.875rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.25rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
            border-radius: 0 2px 2px 0;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Modern Top Navbar */
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            text-decoration: none;
        }

        .navbar-brand .logo-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: rgb(229, 203, 255) !important;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
            background: rgba(78, 115, 223, 0.1);
        }

        .nav-link.menu-ungu {
            color:rgb(180, 105, 234) !important;
            font-weight: 600;
        }

        .nav-link.menu-ungu:hover,
        .nav-link.menu-ungu.active {
            color: #5a32a3 !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            cursor: pointer;
            background: #ffffff;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: #f0f2f5;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #4e73df, #36b9cc);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 0.75rem;
            color: #6c747dff;
            font-weight: 500;
        }

        .user-email {
            font-size: 0.75rem;
            color: #adb5bd;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            min-width: 220px;
            border-radius: 1rem;
            padding: 0.5rem 0;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background: #f0f2f5;
            color: #4e73df;
        }

        /* Content Area */
        .content-wrapper {
            padding: 2rem;
            background: white;
            margin: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* Dashboard Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .stats-card .card-body {
            position: relative;
            z-index: 1;
        }

        .stats-card-primary {
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
        }

        .stats-card-success {
            background: linear-gradient(135deg, #1cc88a 0%, #36b9cc 100%);
        }

        .stats-card-info {
            background: linear-gradient(135deg, #36b9cc 0%, #4e73df 100%);
        }

        .stats-card-warning {
            background: linear-gradient(135deg, #f6c23e 0%, #e74a3b 100%);
        }

        .stats-card-danger {
            background: linear-gradient(135deg, #e74a3b 0%, #f6c23e 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8, #2ea8b8);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        /* Modern Tables */
        .table-modern {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .table-modern thead th {
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: rgba(78, 115, 223, 0.05);
            transform: scale(1.01);
        }

        .table-modern tbody td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid #f8f9fa;
            vertical-align: middle;
        }

        /* Modern Buttons */
        .btn-modern {
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-edit {
            background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
            color: white;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #ff8c00 0%, #ffc107 100%);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
            color: white;
        }

        .btn-view {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #138496 0%, #17a2b8 100%);
            color: white;
        }

        .btn-status {
            border: none;
            border-radius: 2rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-status-pending {
            background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
            color: white;
        }

        .btn-status-confirmed {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }

        .btn-status-completed {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .btn-status-cancelled {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        /* Badge Modern */
        .badge-modern {
            border-radius: 2rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-modern.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        }

        .badge-modern.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%) !important;
        }

        .badge-modern.bg-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
        }

        .badge-modern.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .top-navbar {
                padding: 1rem;
            }
            
            .content-wrapper {
                margin: 0.5rem;
                padding: 1rem;
            }
        }

        /* Toggle Button */
        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--dark-color);
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @auth
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="brand-logo">
                    <i class="fas fa-car text-white"></i>
                </div>
                <div class="brand-name">AutoServis</div>
                <div class="brand-subtitle">
                    @if(auth()->user()->isCustomer())
                        Panel Pelanggan
                    @elseif(auth()->user()->isAdmin())
                        Panel Admin
                    @elseif(auth()->user()->isOwner())
                        Panel Owner
                    @endif
                </div>
            </div>
            
            <ul class="nav flex-column">
                @if(auth()->user()->isCustomer())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" 
                           href="{{ route('customer.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.services.*') ? 'active' : '' }}" 
                           href="{{ route('customer.services.index') }}">
                            <i class="fas fa-tools"></i>
                            Daftar Jasa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.bookings.*') ? 'active' : '' }}" 
                           href="{{ route('customer.bookings.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            Booking Saya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.reviews.*') ? 'active' : '' }}" 
                           href="{{ route('customer.reviews.index') }}">
                            <i class="fas fa-star"></i>
                            Review Saya
                        </a>
                    </li>
                @elseif(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" 
                           href="{{ route('admin.bookings.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            Kelola Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.service-types.*') ? 'active' : '' }}" 
                           href="{{ route('admin.service-types.index') }}">
                            <i class="fas fa-cogs"></i>
                            Jenis Layanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.technicians.*') ? 'active' : '' }}" 
                           href="{{ route('admin.technicians.index') }}">
                            <i class="fas fa-user-cog"></i>
                            Teknisi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" 
                           href="{{ route('admin.reviews.index') }}">
                            <i class="fas fa-star"></i>
                            Review Pelanggan
                        </a>
                    </li>
                @elseif(auth()->user()->isOwner())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}" 
                           href="{{ route('owner.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.bookings.*') ? 'active' : '' }}" 
                           href="{{ route('owner.bookings.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            Kelola Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.service-types.*') ? 'active' : '' }}" 
                           href="{{ route('owner.service-types.index') }}">
                            <i class="fas fa-cogs"></i>
                            Jenis Layanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.technicians.*') ? 'active' : '' }}" 
                           href="{{ route('owner.technicians.index') }}">
                            <i class="fas fa-user-cog"></i>
                            Teknisi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.reviews.*') ? 'active' : '' }}" 
                           href="{{ route('owner.reviews.index') }}">
                            <i class="fas fa-star"></i>
                            Review Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.users.*') ? 'active' : '' }}" 
                           href="{{ route('owner.users.index') }}">
                            <i class="fas fa-users"></i>
                            Kelola User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}" 
                           href="{{ route('owner.reports.index') }}">
                            <i class="fas fa-chart-bar"></i>
                            Laporan & Analytics
                        </a>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <a href="#" class="navbar-brand">
                            <i class="fas fa-car logo-icon me-2"></i>
                            AutoServis
                        </a>
                        
                        <div class="d-none d-md-flex align-items-center gap-4">
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.dashboard') }}" class="nav-link menu-ungu {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('customer.services.index') }}" class="nav-link menu-ungu {{ request()->routeIs('customer.services.*') ? 'active' : '' }}">
                                    Layanan
                                </a>
                                <a href="{{ route('customer.bookings.index') }}" class="nav-link menu-ungu {{ request()->routeIs('customer.bookings.*') ? 'active' : '' }}">
                                    Booking Saya
                                </a>
                            @elseif(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="nav-link menu-ungu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.bookings.index') }}" class="nav-link menu-ungu {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                                    Kelola Booking
                                </a>
                                <a href="{{ route('admin.service-types.index') }}" class="nav-link menu-ungu {{ request()->routeIs('admin.service-types.*') ? 'active' : '' }}">
                                    Layanan
                                </a>
                            @elseif(auth()->user()->isOwner())
                                <a href="{{ route('owner.dashboard') }}" class="nav-link menu-ungu {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('owner.bookings.index') }}" class="nav-link menu-ungu {{ request()->routeIs('owner.bookings.*') ? 'active' : '' }}">
                                    Kelola Booking
                                </a>
                                <a href="{{ route('owner.reports.index') }}" class="nav-link menu-ungu {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}">
                                    Laporan
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="dropdown">
                        <div class="user-profile" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                {{ substr(auth()->user()->name, 0, 2) }}
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="user-role">{{ auth()->user()->role->display_name }}</div>
                                <div class="user-email">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="dropdown-item-text">
                                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                                    <small class="text-muted">{{ auth()->user()->email }}</small>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    @else
        @yield('content')
    @endauth

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
    
    <script>
        // Handle logout form submission
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    // Show loading state
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Logging out...';
                    submitBtn.disabled = true;
                });
            }
        });

        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
     @include('layouts.footer')

</body>
</html>
