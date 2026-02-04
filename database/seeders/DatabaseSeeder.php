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
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Optimized DatabaseSeeder
 *
 * Creates test data with proper foreign key relationships:
 * - 1 SuperAdmin, 1 Admin
 * - 2 Partners (each with 25 meals = 50 total)
 * - 2 Members (each places 25 orders = 50 total)
 * - 2 Drivers (each assigned 25 deliveries = 50 total)
 * - 50 Geolocations, 50 Surveys, 50 Subscriptions, 50 Subscription Items
 *
 * Execution time: < 10 seconds
 */
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $password = Hash::make('password');

        // ============================================
        // 1. Admin Users (2 total)
        // ============================================
        $superadmin = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_SUPERADMIN,
            'phone' => '+1 555-0001',
            'address' => '1 Admin Plaza, Central City',
            'age' => 35,
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_ADMIN,
            'phone' => '+1 555-0002',
            'address' => '2 Admin Plaza, Central City',
            'age' => 30,
        ]);

        // ============================================
        // 2. Partner Users + Partner Records (2 total)
        // ============================================
        $partnerUser1 = User::create([
            'name' => 'Heritage Kitchen Owner',
            'username' => 'partner1',
            'email' => 'partner1@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_PARTNER,
            'phone' => '+1 555-1001',
            'address' => '100 Restaurant Row',
            'age' => 45,
        ]);

        $partner1 = Partner::create([
            'userID' => $partnerUser1->id,
            'restaurantName' => 'Heritage Kitchen',
            'ownerName' => 'Chef Maria Santos',
            'restaurantAddress' => '100 Restaurant Row, Food District',
            'restaurantContact' => '+1 555-1001',
            'restaurantImage' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800',
            'foodType' => 'non vegan friendly',
        ]);

        $partnerUser2 = User::create([
            'name' => 'Nusantara Delights Owner',
            'username' => 'partner2',
            'email' => 'partner2@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_PARTNER,
            'phone' => '+1 555-1002',
            'address' => '200 Spice Lane',
            'age' => 40,
        ]);

        $partner2 = Partner::create([
            'userID' => $partnerUser2->id,
            'restaurantName' => 'Nusantara Delights',
            'ownerName' => 'Chef Budi Hartono',
            'restaurantAddress' => '200 Spice Lane, Flavor Town',
            'restaurantContact' => '+1 555-1002',
            'restaurantImage' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800',
            'foodType' => 'halal-certified',
        ]);

        $partners = [$partner1, $partner2];

        // ============================================
        // 3. Meals (25 per Partner = 50 total)
        // ============================================
        $mealTemplates = [
            'Beef Rendang', 'Chicken Satay', 'Nasi Goreng', 'Gado Gado', 'Soto Ayam',
            'Mie Goreng', 'Bakso', 'Ayam Bakar', 'Ikan Bakar', 'Sayur Lodeh',
            'Nasi Uduk', 'Ketoprak', 'Pempek', 'Rawon', 'Gudeg',
            'Sate Padang', 'Rendang Jengkol', 'Gulai Kambing', 'Opor Ayam', 'Sambal Goreng',
            'Nasi Kuning', 'Bubur Ayam', 'Lontong Sayur', 'Pecel Lele', 'Ayam Geprek',
        ];
        $mealTypes = ['Asian', 'Vegetarian', 'Soup', 'Grilled', 'Seafood'];
        $mealImages = [
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800',
        ];

        $allMeals = [];
        foreach ($partners as $partner) {
            foreach ($mealTemplates as $i => $mealName) {
                $allMeals[] = Meal::create([
                    'partnerID' => $partner->id,
                    'mealName' => $mealName.' ('.$partner->restaurantName.')',
                    'mealIngredient' => fake()->paragraph(),
                    'mealImage' => $mealImages[$i % 3],
                    'mealDescription' => 'Signature dish from '.$partner->restaurantName,
                    'mealType' => $mealTypes[$i % 5],
                    'mealAvailability' => 'Available',
                ]);
            }
        }

        // ============================================
        // 4. Member Users (2 total)
        // ============================================
        $member1 = User::create([
            'name' => 'John Elderly',
            'username' => 'member1',
            'email' => 'member1@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_MEMBER,
            'phone' => '+1 555-2001',
            'address' => '10 Senior Lane, Comfort District',
            'age' => 72,
        ]);

        $member2 = User::create([
            'name' => 'Mary Senior',
            'username' => 'member2',
            'email' => 'member2@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_MEMBER,
            'phone' => '+1 555-2002',
            'address' => '20 Elder Street, Care Village',
            'age' => 68,
        ]);

        $members = [$member1, $member2];

        // ============================================
        // 5. Driver Users (2 total)
        // ============================================
        $driver1 = User::create([
            'name' => 'Alex Driver',
            'username' => 'driver1',
            'email' => 'driver1@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_DRIVER,
            'phone' => '+1 555-3001',
            'address' => '100 Delivery Hub, Transit Zone',
            'age' => 28,
        ]);

        $driver2 = User::create([
            'name' => 'Sam Volunteer',
            'username' => 'driver2',
            'email' => 'driver2@merrymeals.com',
            'password' => $password,
            'role' => User::ROLE_DRIVER,
            'phone' => '+1 555-3002',
            'address' => '200 Courier Lane, Logistics Park',
            'age' => 32,
        ]);

        $drivers = [$driver1, $driver2];
        $allUsers = [$member1, $member2, $driver1, $driver2];

        // ============================================
        // 6. Orders (25 per Member = 50 total)
        // ============================================
        $statuses = [
            Order::STATUS_PREPARATION,
            Order::STATUS_READY,
            Order::STATUS_ASSIGNED,
            Order::STATUS_PICKED_UP,
            Order::STATUS_IN_TRANSIT,
            Order::STATUS_DELIVERED,
        ];
        $packages = ['daily', 'weekly', 'monthly'];
        $temps = ['hot', 'cold'];

        for ($i = 0; $i < 50; $i++) {
            $member = $members[$i % 2];
            $driver = $drivers[$i % 2];
            $meal = $allMeals[$i];
            $partner = $partners[$i < 25 ? 0 : 1];

            Order::create([
                'userID' => $member->id,
                'partnerID' => $partner->id,
                'mealID' => $meal->id,
                'volunteerID' => $driver->id,
                'status' => $statuses[array_rand($statuses)],
                'mealPackage' => $packages[array_rand($packages)],
                'foodTemperature' => $temps[array_rand($temps)],
                'range' => rand(1, 15),
                'created_at' => $now->copy()->subDays(rand(0, 30)),
            ]);
        }

        // ============================================
        // 7. Surveys (50 total)
        // ============================================
        $surveyOptions = ['Very Poor', 'Poor', 'Average', 'Good', 'Excellent'];

        for ($i = 0; $i < 50; $i++) {
            Survey::create([
                'userID' => $members[$i % 2]->id,
                'questionOne' => $surveyOptions[array_rand($surveyOptions)],
                'questionTwo' => $surveyOptions[array_rand($surveyOptions)],
                'questionThree' => $surveyOptions[array_rand($surveyOptions)],
                'questionFour' => $surveyOptions[array_rand($surveyOptions)],
                'questionFive' => $surveyOptions[array_rand($surveyOptions)],
                'questionSix' => $surveyOptions[array_rand($surveyOptions)],
                'questionSeven' => $surveyOptions[array_rand($surveyOptions)],
                'questionEight' => $surveyOptions[array_rand($surveyOptions)],
                'overall' => $surveyOptions[rand(3, 4)],
            ]);
        }

        // ============================================
        // 8. Donations (50 total)
        // ============================================
        Donation::factory(50)->create();

        // ============================================
        // 9. Inquiries (50 total)
        // ============================================
        Inquiry::factory(50)->create();

        // ============================================
        // 10. Geolocations (50 total)
        // ============================================
        for ($i = 0; $i < 50; $i++) {
            Geolocation::create([
                'userID' => $allUsers[$i % 4]->id,
                'partnerID' => $partners[$i % 2]->id,
                'ip' => fake()->ipv4(),
                'countryName' => 'Indonesia',
                'countryCode' => 'ID',
                'regionName' => 'Bali',
                'cityName' => fake()->randomElement(['Denpasar', 'Ubud', 'Kuta', 'Sanur']),
                'latitude' => fake()->latitude(-8.5, -8.8),
                'longitude' => fake()->longitude(115.1, 115.3),
            ]);
        }

        // ============================================
        // 11. Subscriptions (50 total)
        // ============================================
        $stripeStatuses = ['active', 'canceled', 'past_due', 'trialing'];
        $subscriptionNames = ['Basic Plan', 'Premium Plan', 'Family Plan'];

        for ($i = 0; $i < 50; $i++) {
            $subscriptionId = DB::table('subscriptions')->insertGetId([
                'user_id' => $allUsers[$i % 4]->id,
                'name' => $subscriptionNames[array_rand($subscriptionNames)],
                'stripe_id' => 'sub_'.Str::random(14).$i,
                'stripe_status' => $stripeStatuses[array_rand($stripeStatuses)],
                'stripe_price' => 'price_'.Str::random(14),
                'quantity' => rand(1, 3),
                'trial_ends_at' => rand(0, 1) ? $now->copy()->addDays(rand(7, 30)) : null,
                'ends_at' => rand(0, 1) ? $now->copy()->addMonths(rand(1, 12)) : null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // ============================================
            // 12. Subscription Items (1 per Subscription = 50 total)
            // ============================================
            DB::table('subscription_items')->insert([
                'subscription_id' => $subscriptionId,
                'stripe_id' => 'si_'.Str::random(14).$i,
                'stripe_product' => 'prod_'.Str::random(14),
                'stripe_price' => 'price_'.Str::random(14),
                'quantity' => rand(1, 5),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
