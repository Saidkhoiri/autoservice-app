<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoServis - Bengkel Terpercaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
            color: white;
        }

        .hero-section {
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, var(--danger-color), #ff6b6b);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.4);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 30px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        .stats-section {
            background: white;
            padding: 3rem 0;
            margin-top: -100px;
            position: relative;
            z-index: 3;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--dark-color);
            font-weight: 500;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            text-align: center;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 3rem;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f1f3f4;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .service-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .service-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .service-content {
            padding: 2rem;
        }

        .service-category {
            background: #e9ecef;
            color: var(--dark-color);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .service-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .btn-book {
            background: var(--dark-color);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-book:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            color: white;
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
            border: 1px solid #f1f3f4;
        }

        .testimonial-rating {
            color: #ffc107;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 5rem 0;
            color: white;
            text-align: center;
        }

        .btn-cta-primary {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 12px 32px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
            color: var(--primary-color);
        }

        .btn-cta-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 12px 32px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-cta-outline:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer {
            background: rgba(11, 41, 84, 0.99);
            color: rgb(112, 143, 235);
            padding: 3rem 0 1rem;
        }

        .footer .text-muted {
            color:rgb(211, 228, 251) !important;
        }


        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .stats-section {
                margin-top: -50px;
            }
        }
        .cta-title {
            font-size: 2.7rem;
            line-height: 1.3;
        }
    </style>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050;" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050;" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-car me-2"></i>
                AutoServis
                <div class="small text-muted">Bengkel Terpercaya</div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                </ul>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <i class="fas fa-car me-2"></i>
                        Bengkel Terpercaya #1 di Kota
                    </div>
                    
                    <h1 class="hero-title">
                        Servis Kendaraan <span class="highlight">Professional</span>
                    </h1>
                    
                    <p class="hero-description">
                        Booking online mudah, teknisi berpengalaman, dan kualitas terjamin. 
                        Jadwalkan servis kendaraan Anda sekarang juga!
                    </p>
                    
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom">
                            <i class="fas fa-arrow-right me-2"></i>
                            Mulai Booking
                        </a>
                        <a href="#layanan" class="btn btn-outline-custom">
                            <i class="fas fa-tags me-2"></i>
                            Cek Harga Servis
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="images/car.jpg" 
                             alt="Mechanic working" class="img-fluid rounded-4 shadow-lg">
                        
                        <div class="position-absolute bottom-0 end-0 bg-white rounded-3 p-3 m-3 shadow">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <div>
                                    <div class="fw-bold">Garansi Servis</div>
                                    <small class="text-muted">30 hari atau 5000 km</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Teknisi Ahli</div>
                </div>
                <div class="col-md-3 col-6 text-center">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Siaga</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Mengapa Pilih AutoServis?</h2>
            <p class="section-subtitle">Kami memberikan pelayanan terbaik dengan standar kualitas tinggi</p>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="h5">Booking Online 24/7</h3>
                        <p class="text-muted">Reservasi kapan saja, di mana saja melalui sistem online kami</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="h5">Teknisi Berpengalaman</h3>
                        <p class="text-muted">Dikerjakan oleh teknisi profesional dan berpengalaman</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3 class="h5">Peralatan Modern</h3>
                        <p class="text-muted">Menggunakan peralatan dan teknologi terkini</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3 class="h5">Semua Jenis Kendaraan</h3>
                        <p class="text-muted">Melayani mobil, motor, dan kendaraan komersial</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light" id="layanan">
        <div class="container">
            <h2 class="section-title">Layanan Populer</h2>
            <p class="section-subtitle">Pilihan layanan yang paling banyak dipilih pelanggan</p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-header">
                            <i class="fas fa-wrench fa-3x mb-3"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="h5">Ganti Oli Mesin</h3>
                            <span class="service-category">Perawatan Rutin</span>
                            <p class="text-muted mb-3">Penggantian oli mesin berkualitas dengan filter oli baru</p>
                            <div class="service-price">Rp 150.000</div>
                            <div class="text-muted mb-3">30 menit</div>
                            <a href="{{ route('register') }}" class="btn btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-header">
                            <i class="fas fa-wrench fa-3x mb-3"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="h5">Tune Up</h3>
                            <span class="service-category">Perawatan Rutin</span>
                            <p class="text-muted mb-3">Pembersihan dan penyetelan mesin untuk performa optimal</p>
                            <div class="service-price">Rp 300.000</div>
                            <div class="text-muted mb-3">90 menit</div>
                            <a href="{{ route('register') }}" class="btn btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-header">
                            <i class="fas fa-wrench fa-3x mb-3"></i>
                        </div>
                        <div class="service-content">
                            <h3 class="h5">Servis AC</h3>
                            <span class="service-category">AC & Elektrik</span>
                            <p class="text-muted mb-3">Pembersihan dan pengisian freon AC kendaraan</p>
                            <div class="service-price">Rp 200.000</div>
                            <div class="text-muted mb-3">60 menit</div>
                            <a href="{{ route('register') }}" class="btn btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Testimoni Pelanggan</h2>
            <p class="section-subtitle">Kepuasan pelanggan adalah prioritas utama kami</p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted mb-3">"Pelayanan sangat memuaskan, teknisi profesional dan harga terjangkau."</p>
                        <div class="fw-bold">Ahmad Budi</div>
                        <div class="text-muted small">Layanan: Tune Up</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted mb-3">"Booking online sangat mudah, tidak perlu antri lama. Recommended!"</p>
                        <div class="fw-bold">Sari Wulandari</div>
                        <div class="text-muted small">Layanan: Ganti Oli</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p class="text-muted mb-3">"Kualitas kerja bagus, mobil jadi lebih nyaman setelah service AC."</p>
                        <div class="fw-bold">Rio Pratama</div>
                        <div class="text-muted small">Layanan: Servis AC</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="display-4 fw-bold mb-3 cta-title">Siap untuk Servis Kendaraan Anda?</h2>
            <p class="lead mb-4">Booking sekarang dan dapatkan pelayanan terbaik dari teknisi profesional kami</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-cta-primary">
                    <i class="fas fa-arrow-right me-2"></i>
                    Mulai Booking Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-cta-outline">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Masuk ke Akun
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <div class="mb-3">
                <h4 class="fw-bold">
                    <i class="fas fa-car me-2"></i>
                    AutoServis
                </h4>
            </div>
            <p class="text-muted mb-3">
                Bengkel terpercaya dengan pelayanan profesional dan kualitas terjamin. 
                Melayani berbagai jenis kendaraan dengan teknisi berpengalaman.
            </p>
            <div class="border-top pt-3">
                <p class="text-muted">&copy; 2024 AutoServis. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>
</body>
</html>
