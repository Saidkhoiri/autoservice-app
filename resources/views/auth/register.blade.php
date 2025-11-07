<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AutoServis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: url('/images/wp2.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.31);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
            min-height: 700px;
        }

        .register-left {
            background: linear-gradient(135deg,rgba(43, 111, 220, 0.52) 0%,rgba(33, 79, 218, 0.52) 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .register-left-content {
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

        .benefits-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .benefits-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .benefits-list li i {
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .register-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }

        .register-form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #64178bff;
            margin-bottom: 0.5rem;
        }

        .register-form-subtitle {
            color: #232323ff;
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
            border-color: #36b9cc;
            box-shadow: 0 0 0 0.2rem rgba(54, 185, 204, 0.25);
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

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(54, 185, 204, 0.3);
            color: white;
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
        }

        .login-link a {
            color:rgb(218, 228, 254);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .role-selector {
            margin-bottom: 1.5rem;
        }

        .role-options {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .role-option {
            flex: 1;
            position: relative;
        }

        .role-option input[type="radio"] {
            display: none;
        }

        .role-option label {
            display: block;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .role-option input[type="radio"]:checked + label {
            border-color: #c5a2ffff;
            background: linear-gradient(135deg, #c198ffff 0%, #6366fdff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(54, 185, 204, 0.3);
        }

        .role-option label:hover {
            border-color: #36b9cc;
            transform: translateY(-1px);
        }

        .role-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        @media (max-width: 768px) {
            .register-card {
                flex-direction: column;
                max-width: 400px;
            }

            .register-left {
                padding: 2rem;
            }

            .register-right {
                padding: 2rem;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .role-options {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Left Side - Welcome & Benefits -->
            <div class="register-left">
                <div class="register-left-content">
                    <div class="brand-logo">
                        <i class="fas fa-car"></i>
                        AutoServis
                    </div>
                    
                    <h1 class="welcome-title">Bergabung Bersama Kami!</h1>
                    <p class="welcome-subtitle">
                        Daftar sekarang dan nikmati kemudahan booking servis kendaraan online dengan pelayanan terbaik dari teknisi profesional kami.
                    </p>
                    
                    <ul class="benefits-list">
                        <li>
                            <i class="fas fa-user-plus"></i>
                            Registrasi Mudah & Cepat
                        </li>
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            Keamanan Data Terjamin
                        </li>
                        <li>
                            <i class="fas fa-gift"></i>
                            Bonus Member Pertama
                        </li>
                        <li>
                            <i class="fas fa-headset"></i>
                            Layanan Customer 24/7
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="register-right">
                <h2 class="register-form-title">Daftar Akun</h2>
                <p class="register-form-subtitle">Lengkapi data diri Anda untuk membuat akun baru</p>

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

                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" placeholder="Masukkan nama lengkap" 
                               value="{{ old('name') }}" required autocomplete="off">
                        <label for="name">
                            <i class="fas fa-user me-2"></i>
                            Nama Lengkap
                        </label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="Masukkan email" 
                               value="{{ old('email') }}" required autocomplete="off">
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>
                            Email
                        </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" placeholder="Masukkan nomor telepon" 
                               value="{{ old('phone') }}" required autocomplete="off">
                        <label for="phone">
                            <i class="fas fa-phone me-2"></i>
                            Nomor Telepon
                        </label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" placeholder="Masukkan alamat lengkap" 
                                  style="height: 100px" required autocomplete="off">{{ old('address') }}</textarea>
                        <label for="address">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Alamat Lengkap
                        </label>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="role-selector">
                        <label class="form-label">
                            <i class="fas fa-users me-2"></i>
                            Pilih Role
                        </label>
                        <div class="role-options">
                            <div class="role-option">
                                <input type="radio" id="customer" name="role_id" value="1" {{ old('role_id') == '1' ? 'checked' : '' }} required>
                                <label for="customer">
                                    <i class="fas fa-user role-icon"></i>
                                    Pelanggan
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" id="admin" name="role_id" value="2" {{ old('role_id') == '2' ? 'checked' : '' }}>
                                <label for="admin">
                                    <i class="fas fa-user-cog role-icon"></i>
                                    Admin Bengkel
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" id="owner" name="role_id" value="3" {{ old('role_id') == '3' ? 'checked' : '' }}>
                                <label for="owner">
                                    <i class="fas fa-crown role-icon"></i>
                                    Pemilik Bengkel
                                </label>
                            </div>
                        </div>
                        @error('role_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating position-relative">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Masukkan password" 
                               required autocomplete="new-password">
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>
                            Password
                        </label>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating position-relative">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" 
                               required autocomplete="new-password">
                        <label for="password_confirmation">
                            <i class="fas fa-lock me-2"></i>
                            Konfirmasi Password
                        </label>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="password-confirmation-icon"></i>
                        </button>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>
                        Daftar Sekarang
                    </button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const passwordIcon = document.getElementById(fieldId === 'password' ? 'password-icon' : 'password-confirmation-icon');
            
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
    </script>
</body>
</html>
