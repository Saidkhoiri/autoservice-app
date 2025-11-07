<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bengkel - {{ $date ?? now()->format('d F Y') }}</title>
    <style>
        /* ====== RESET DAN FONT ====== */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 12px;
            color: #333;
            background: #fff;
            padding: 30px;
        }

        /* ====== HEADER ====== */
        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #007bff;
            letter-spacing: 1px;
        }
        .header p {
            font-size: 13px;
            color: #555;
        }

        /* ====== SUMMARY ====== */
        .summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        .card {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-left: 6px solid #007bff;
            border-radius: 6px;
            background: #f9fbff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .card strong {
            color: #007bff;
            font-size: 13px;
        }

        /* ====== TABLE ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead {
            background-color: #007bff;
            color: white;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* ====== FOOTER ====== */
        .footer {
            text-align: right;
            font-size: 11px;
            color: #777;
            margin-top: 25px;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }

        /* ====== TITLES ====== */
        h2, h3 {
            color: #007bff;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <h1>Laporan & Analisis Bengkel</h1>
        <p>Tanggal Cetak: {{ $date ?? now()->format('d F Y') }}</p>
    </div>

    <!-- RINGKASAN -->
    <div class="summary">
        <div class="card">
            <strong>Total Pendapatan</strong><br>
            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
        </div>
        <div class="card">
            <strong>Total Booking</strong><br>
            {{ $totalBookings }}
        </div>
        <div class="card">
            <strong>Total Customer</strong><br>
            {{ $totalCustomers }}
        </div>
        <div class="card">
            <strong>Rata-rata Rating</strong><br>
            {{ number_format($averageRating, 1) }} ⭐
        </div>
    </div>

    <!-- TABEL BOOKING -->
    <h3>📋 Daftar Booking Terbaru</h3>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentBookings as $booking)
            <tr>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->serviceType->name }}</td>
                <td>{{ $booking->booking_date->format('d M Y') }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak oleh sistem BengkelKu | {{ now()->format('d M Y, H:i') }}
    </div>
</body>
</html>
