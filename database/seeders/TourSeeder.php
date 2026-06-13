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

        // 2. Create Sample Tour
        $tour = \App\Models\Tour::create([
            'name' => 'Bali Cultural Trip',
            'description' => 'A beautiful trip to explore Bali culture and beaches.',
        ]);

        // 3. Create Package
        $package = $tour->tourPackages()->create([
            'name' => 'Kuta Special',
            'description' => 'Includes hotel and transport.',
            'price' => 2500000
        ]);

        // 4. Create Schedule
        $schedule = $package->schedules()->create([
            'start_date' => '2026-07-01',
            'end_date' => '2026-07-05'
        ]);

        // 5. Create Booking
        \App\Models\Booking::create([
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'total_persons' => 2,
            'total_price' => 5000000,
            'status' => 'confirmed'
        ]);
    }
}
