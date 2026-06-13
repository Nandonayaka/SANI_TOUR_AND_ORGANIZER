<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin
        $user = \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin Sani Tour', 'password' => bcrypt('password')]
        );

        // 2. Buat Contoh Wisata
        $tour = \App\Models\Tour::create([
            'name' => 'Wisata Budaya Bali',
            'description' => 'Perjalanan indah menjelajahi budaya dan pantai di Bali.',
        ]);

        // 3. Buat Paket
        $package = $tour->tourPackages()->create([
            'name' => 'Kuta Spesial',
            'description' => 'Termasuk hotel bintang 5 dan transportasi.',
            'price' => 2500000
        ]);

        // 4. Buat Jadwal
        $schedule = $package->schedules()->create([
            'start_date' => '2026-07-01',
            'end_date' => '2026-07-05'
        ]);

        // 5. Buat Pesanan
        \App\Models\Booking::create([
            'customer_name' => 'Budi Santoso',
            'customer_phone' => '081234567890',
            'schedule_id' => $schedule->id,
            'total_persons' => 2,
            'total_price' => 5000000,
            'status' => 'confirmed'
        ]);
    }
}
