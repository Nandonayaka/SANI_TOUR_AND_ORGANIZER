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
        $user = \App\Models\User::first() ?? \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $tour = \App\Models\Tour::create([
                'name' => "Tour Destination $i",
                'description' => "Enchanting destination $i with beautiful views and historical landmarks.",
                'image' => "https://picsum.photos/seed/tour$i/800/600"
            ]);

            for ($j = 1; $j <= 2; $j++) {
                $package = $tour->tourPackages()->create([
                    'name' => "Package $j for $tour->name",
                    'description' => "Standard package $j including transport and guide.",
                    'price' => rand(100, 500) * 1000
                ]);

                $schedule = $package->schedules()->create([
                    'start_date' => now()->addDays(rand(1, 30)),
                    'end_date' => now()->addDays(rand(31, 40))
                ]);

                \App\Models\Booking::create([
                    'user_id' => $user->id,
                    'schedule_id' => $schedule->id,
                    'total_persons' => rand(1, 4),
                    'total_price' => $package->price * rand(1, 4),
                    'status' => 'confirmed'
                ]);
            }
        }
    }
}
