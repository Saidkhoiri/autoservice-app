# Bengkel Online - Sistem Booking Service Kendaraan

Aplikasi web berbasis Laravel 10 untuk sistem booking service kendaraan dengan manajemen bengkel yang terintegrasi.

## Fitur Utama

### 🚗 Daftar Jasa
- Menampilkan jenis layanan servis yang tersedia
- Informasi detail harga dan durasi service
- Status ketersediaan layanan

### 📅 Form Booking
- Memesan jadwal servis dengan memilih tanggal dan waktu
- Pemilihan teknisi yang tersedia
- Input detail kendaraan (nomor plat, merk, model)
- Catatan tambahan untuk service

### 📊 Status Booking
- Memantau status pesanan (pending, terkonfirmasi, selesai, dibatalkan)
- Notifikasi perubahan status
- Riwayat booking lengkap

### 🛠️ Manajemen Bengkel
- Admin dapat mengelola jadwal booking
- Menugaskan teknisi untuk booking
- Mengelola daftar jasa dan teknisi
- Monitoring status booking

### ⭐ Review Pelanggan
- Pelanggan dapat memberikan ulasan setelah servis selesai
- Sistem rating bintang (1-5)
- Komentar dan feedback
- Moderasi review oleh admin

## Level User

### 1. Pelanggan (Customer)
- Melihat jasa servis yang tersedia
- Melakukan booking service
- Melihat status pesanan
- Memberikan review setelah service selesai
- Mengelola profil dan riwayat booking

### 2. Admin Bengkel
- Mengelola jadwal booking
- Menugaskan teknisi
- Mengelola daftar jasa
- Mengelola booking pelanggan
- Moderasi review pelanggan

### 3. Pemilik Bengkel (Owner)
- Semua hak akses Admin
- Melihat laporan pendapatan
- Mengelola user (customer, admin, teknisi)
- Akses penuh ke semua fitur sistem

## Teknologi yang Digunakan

- **Backend**: Laravel 10
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome
- **Authentication**: Laravel Built-in Auth
- **Authorization**: Custom Role-based Middleware

## Instalasi

### Prerequisites
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL
- Node.js (untuk asset compilation)

### Langkah Instalasi

1. **Clone repository**
```bash
git clone <repository-url>
cd project_said
```

2. **Install dependencies**
```bash
composer install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bengkel_online
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan migration dan seeder**
```bash
php artisan migrate:fresh --seed
```

6. **Jalankan server development**
```bash
php artisan serve
```

## Data Default

Setelah menjalankan seeder, sistem akan memiliki data default:

### User Login
- **Admin**: admin@bengkel.com / password
- **Owner**: owner@bengkel.com / password
- **Customer**: john@example.com / password

### Role
- Customer (Pelanggan)
- Admin (Admin Bengkel)
- Owner (Pemilik Bengkel)

### Service Types
- Ganti Oli Mesin (Rp 150.000, 30 menit)
- Ganti Oli Gardan (Rp 100.000, 20 menit)
- Tune Up (Rp 200.000, 45 menit)

### Technicians
- Ahmad Supriadi (Spesialis mesin dan transmisi)
- Budi Santoso (Spesialis kelistrikan dan AC)
- Candra Wijaya (Spesialis rem dan suspensi)
- Dedi Kurniawan (Spesialis tune up dan service berkala)

## Struktur Database

### Tables
- `users` - Data pengguna (customer, admin, owner)
- `roles` - Role pengguna
- `service_types` - Jenis layanan service
- `technicians` - Data teknisi
- `bookings` - Data booking service
- `reviews` - Review pelanggan

### Relationships
- User belongs to Role
- User has many Bookings
- User has many Reviews
- ServiceType has many Bookings
- Technician has many Bookings
- Booking belongs to User, ServiceType, Technician
- Booking has one Review
- Review belongs to Booking and User

## Fitur CRUD

### Booking Management
- ✅ Create booking (Customer)
- ✅ Read booking list (Customer/Admin/Owner)
- ✅ Update booking status (Admin/Owner)
- ✅ Delete booking (Customer/Admin/Owner)

### Service Type Management
- ✅ Create service type (Admin/Owner)
- ✅ Read service type list (Admin/Owner)
- ✅ Update service type (Admin/Owner)
- ✅ Delete service type (Admin/Owner)
- ✅ Toggle service status (Admin/Owner)

### Technician Management
- ✅ Create technician (Admin/Owner)
- ✅ Read technician list (Admin/Owner)
- ✅ Update technician (Admin/Owner)
- ✅ Delete technician (Admin/Owner)
- ✅ Toggle technician status (Admin/Owner)

### User Management (Owner Only)
- ✅ Create user (Owner)
- ✅ Read user list (Owner)
- ✅ Update user (Owner)
- ✅ Delete user (Owner)
- ✅ Toggle user status (Owner)

### Review Management
- ✅ Create review (Customer)
- ✅ Read review list (Customer/Admin/Owner)
- ✅ Update review (Customer)
- ✅ Delete review (Customer/Admin/Owner)
- ✅ Approve/Reject review (Admin/Owner)

## Security Features

- **Authentication**: Laravel built-in authentication
- **Authorization**: Role-based access control
- **Middleware**: Custom CheckRole middleware
- **Validation**: Form validation untuk semua input
- **CSRF Protection**: Laravel CSRF token protection

## API Endpoints

### Authentication
- `GET /login` - Login page
- `POST /login` - Login process
- `GET /register` - Register page
- `POST /register` - Register process
- `POST /logout` - Logout

### Customer Routes
- `GET /customer/dashboard` - Customer dashboard
- `GET /customer/services` - Service list
- `GET /customer/bookings` - Customer bookings
- `POST /customer/bookings` - Create booking
- `GET /customer/reviews` - Customer reviews

### Admin Routes
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/service-types` - Manage service types
- `GET /admin/technicians` - Manage technicians
- `GET /admin/bookings` - Manage bookings
- `GET /admin/reviews` - Manage reviews

### Owner Routes
- `GET /owner/dashboard` - Owner dashboard
- `GET /owner/users` - Manage users
- All admin routes + additional owner features

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

Untuk dukungan atau pertanyaan, silakan hubungi:
- Email: support@bengkelonline.com
- Phone: +62 812-3456-7890

## Changelog

### Version 1.0.0
- Initial release
- Complete CRUD functionality
- Role-based access control
- Booking management system
- Review system
- User management (Owner)
- Responsive design with Bootstrap 5
