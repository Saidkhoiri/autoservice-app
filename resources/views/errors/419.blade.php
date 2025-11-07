<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Page Expired | AutoServis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .error-container {
            text-align: center;
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }
        
        .error-code {
            font-size: 4rem;
            font-weight: 800;
            color: #e74a3b;
            margin-bottom: 1rem;
        }
        
        .error-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 1rem;
        }
        
        .error-message {
            color: #6c757d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4e73df, #36b9cc);
            border: none;
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
        }
        
        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            padding: 12px 32px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
        }
        
        .icon {
            font-size: 3rem;
            color: #e74a3b;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <div class="error-code">419</div>
        
        <h1 class="error-title">Halaman Kedaluwarsa</h1>
        
        <p class="error-message">
            Maaf, sesi Anda telah kedaluwarsa. Ini biasanya terjadi karena:
        </p>
        
        <ul class="text-start text-muted mb-4">
            <li>Halaman dibuka terlalu lama</li>
            <li>Token keamanan telah kedaluwarsa</li>
            <li>Ada masalah dengan sesi browser</li>
        </ul>
        
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>
                Kembali ke Beranda
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                <i class="fas fa-sign-in-alt me-2"></i>
                Login Kembali
            </a>
        </div>
        
        <div class="mt-4">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                Jika masalah berlanjut, coba refresh halaman atau clear cache browser
            </small>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
