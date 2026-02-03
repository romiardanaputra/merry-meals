<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Geolocation;
use App\Models\Inquiry;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Core Users
        User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@merrymeals.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_SUPERADMIN,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@merrymeals.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // 2. Partners (100)
        // Each partner needs a user.
        $partnerUsers = User::factory(100)->partner()->create();
        $partners = [];
        foreach ($partnerUsers as $u) {
            $partners[] = Partner::factory()->create([
                'userID' => $u->id,
                'ownerName' => $u->name
            ]);
        }
        $partners = collect($partners);

        // 3. Meals (100)
        for ($i = 0; $i < 100; $i++) {
            Meal::factory()->create([
                'partnerID' => $partners->random()->id
            ]);
        }
        $meals = Meal::all();

        // 4. Members and Drivers
        $members = User::factory(100)->member()->create();
        $drivers = User::factory(50)->driver()->create();

        // 5. Orders (100)
        for ($i = 0; $i < 100; $i++) {
            $member = $members->random();
            $partner = $partners->random();
            $meal = $meals->where('partnerID', $partner->id);
            
            // If partner has no meals, fallback to any meal
            $selectedMeal = $meal->isEmpty() ? $meals->random() : $meal->random();

            Order::factory()->create([
                'userID' => $member->id,
                'partnerID' => $partner->id,
                'mealID' => $selectedMeal->id,
                'volunteerID' => $drivers->random()->id,
            ]);
        }

        // 6. Generic Data (100 each)
        Donation::factory(100)->create();
        Inquiry::factory(100)->create();
        
        // Survey (100)
        for ($i = 0; $i < 100; $i++) {
            Survey::factory()->create([
                'userID' => $members->random()->id,
            ]);
        }

        // Geolocation (100)
        for ($i = 0; $i < 100; $i++) {
            Geolocation::factory()->create([
                'userID' => User::all()->random()->id,
                'partnerID' => $partners->random()->id,
            ]);
        }
    }
}
