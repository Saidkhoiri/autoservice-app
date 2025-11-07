<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
use App\Models\ServiceType;
use App\Models\Technician;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $customers = User::where('role_id', 1)->get();
        $services = ServiceType::all();
        $technicians = Technician::all();

        // Create bookings for the last 6 months
        for ($i = 180; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Create 1-3 bookings per day
            $bookingsPerDay = rand(1, 3);
            
            for ($j = 0; $j < $bookingsPerDay; $j++) {
                $customer = $customers->random();
                $service = $services->random();
                $technician = $technicians->random();
                
                // Random status with weighted probability
                $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
                $weights = [20, 30, 40, 10]; // 20% pending, 30% confirmed, 40% completed, 10% cancelled
                $status = $this->weightedRandom($statuses, $weights);
                
                $booking = Booking::create([
                    'user_id' => $customer->id,
                    'service_type_id' => $service->id,
                    'technician_id' => $technician->id,
                    'booking_date' => $date->copy()->addDays(rand(1, 7)),
                    'booking_time' => $this->getRandomTime(),
                    'vehicle_number' => 'B ' . rand(1000, 9999) . ' ' . $this->getRandomLetters(3),
                    'vehicle_brand' => $this->getRandomBrand(),
                    'vehicle_model' => $this->getRandomModel(),
                    'notes' => $this->getRandomNotes(),
                    'status' => $status,
                    'total_price' => $service->price,
                ]);

                // Create review for completed bookings
                if ($status === 'completed' && rand(1, 3) === 1) { // 33% chance of review
                    $this->createReview($booking);
                }
            }
        }
    }

    private function weightedRandom($items, $weights)
    {
        $total = array_sum($weights);
        $random = rand(1, $total);
        
        foreach ($items as $index => $item) {
            $random -= $weights[$index];
            if ($random <= 0) {
                return $item;
            }
        }
        
        return $items[0];
    }

    private function getRandomTime()
    {
        $hours = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];
        return $hours[array_rand($hours)];
    }

    private function getRandomLetters($length)
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $letters[rand(0, strlen($letters) - 1)];
        }
        return $result;
    }

    private function getRandomBrand()
    {
        $brands = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Ducati', 'BMW', 'KTM'];
        return $brands[array_rand($brands)];
    }

    private function getRandomModel()
    {
        $models = ['Vario', 'PCX', 'NMAX', 'Aerox', 'GSX-R', 'Ninja', 'Monster', 'S1000RR', 'Duke'];
        return $models[array_rand($models)];
    }

    private function getRandomNotes()
    {
        $notes = [
            'Service berkala rutin',
            'Ada suara aneh di mesin',
            'Rem kurang responsif',
            'AC tidak dingin',
            'Oli perlu diganti',
            'Tune up mesin',
            'Ganti kampas rem',
            'Service karburator',
            'Ganti busi',
            'Service transmisi'
        ];
        return $notes[array_rand($notes)];
    }

    private function createReview($booking)
    {
        $ratings = [4, 5, 4, 5, 4, 5, 3, 5, 4, 5]; // Mostly positive ratings
        $comments = [
            'Service sangat memuaskan, teknisi ramah dan profesional',
            'Hasil service bagus, mesin jadi lebih halus',
            'Pelayanan cepat dan berkualitas',
            'Teknisi sangat teliti dalam melakukan service',
            'Harga terjangkau dengan kualitas yang baik',
            'Bengkel yang terpercaya, sudah langganan lama',
            'Service selesai tepat waktu',
            'Teknisi berpengalaman dan ahli',
            'Bengkel bersih dan rapi',
            'Pelayanan customer service sangat baik'
        ];

        \App\Models\Review::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'rating' => $ratings[array_rand($ratings)],
            'comment' => $comments[array_rand($comments)],
            'is_approved' => true,
        ]);
    }
}
