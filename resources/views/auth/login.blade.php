<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AutoServis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: url('/images/wp1.jpg')no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.31);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
            min-height: 600px;
        }

        .login-left {
            background: linear-gradient(135deg,rgba(78, 114, 223, 0.62) 0%,rgba(54, 147, 204, 0.58) 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .login-left-content {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-logo i {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: 10px;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .features-list li i {
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .demo-accounts {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .demo-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .demo-account {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .demo-account-info {
            display: flex;
            flex-direction: column;
        }

        .demo-role {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .demo-email {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .demo-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 5px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .demo-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .login-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .login-form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #64178bff;
            margin-bottom: 0.5rem;
        }

        .login-form-subtitle {
            color: #111517de;
            margin-bottom: 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .form-floating label {
            padding: 1rem 1rem;
            color: #666;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            z-index: 10;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 2rem;
        }

        .forgot-password a {
            color: rgba(235, 239, 249, 1);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg,rgba(79, 113, 225, 1) 0%,rgba(210, 54, 224, 1) 100%);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(78, 115, 223, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
        }

        .register-link a {
            color:rgb(218, 228, 254);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                max-width: 400px;
            }

            .login-left {
                padding: 2rem;
            }

            .login-right {
                padding: 2rem;
            }

            .welcome-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side - Welcome & Features -->
            <div class="login-left">
                <div class="login-left-content">
                    <div class="brand-logo">
                        <i class="fas fa-car"></i>
                        AutoServis
                    </div>
                    
                    <h1 class="welcome-title">Selamat Datang Kembali!</h1>
                    <p class="welcome-subtitle">
                        Masuk ke akun Anda untuk melanjutkan booking servis kendaraan dan mengelola jadwal servis Anda.
                    </p>
                    
                    <ul class="features-list">
                        <li>
                            <i class="fas fa-clock"></i>
                            Booking Online 24/7
                        </li>
                        <li>
                            <i class="fas fa-user-cog"></i>
                            Teknisi Profesional
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            Tracking Real-time
                        </li>
                        <li>
                            <i class="fas fa-history"></i>
                            Riwayat Lengkap
                        </li>
                    </ul>

                    <div class="demo-accounts">
                        <div class="demo-title">Akun Demo untuk Testing:</div>
                        <div class="demo-account">
                            <div class="demo-account-info">
                                <div class="demo-role">Pelanggan</div>
                                <div class="demo-email">customer@demo.com</div>
                            </div>
                            <button class="demo-btn" onclick="fillDemo('customer@demo.com', 'password123')">Gunakan</button>
                        </div>
                        <div class="demo-account">
                            <div class="demo-account-info">
                                <div class="demo-role">Admin Bengkel</div>
                                <div class="demo-email">admin@demo.com</div>
                            </div>
                            <button class="demo-btn" onclick="fillDemo('admin@demo.com', 'password123')">Gunakan</button>
                        </div>
                        <div class="demo-account">
                            <div class="demo-account-info">
                                <div class="demo-role">Pemilik Bengkel</div>
                                <div class="demo-email">owner@demo.com</div>
                            </div>
                            <button class="demo-btn" onclick="fillDemo('owner@demo.com', 'password123')">Gunakan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right">
                <h2 class="login-form-title">Masuk</h2>
                <p class="login-form-subtitle">Masukkan email dan password Anda untuk melanjutkan</p>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="Masukkan email Anda" 
                               value="{{ old('email') }}" required autocomplete="off">
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>
                            Email
                        </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating position-relative">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Masukkan password Anda" 
                               required autocomplete="new-password">
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>
                            Password
                        </label>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="forgot-password">
                        <a href="#">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Masuk
                    </button>
                </form>

                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        function fillDemo(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            
            // Focus on password field after filling
            document.getElementById('password').focus();
            
            // Show success message
            const demoBtn = event.target;
            const originalText = demoBtn.textContent;
            demoBtn.textContent = '✓ Terisi';
            demoBtn.style.background = 'rgba(255, 255, 255, 0.3)';
            
            setTimeout(() => {
                demoBtn.textContent = originalText;
                demoBtn.style.background = 'rgba(255, 255, 255, 0.2)';
            }, 2000);
        }
    </script>
</body>
</html>
