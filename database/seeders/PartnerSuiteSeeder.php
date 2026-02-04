<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Partner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PartnerSuiteSeeder extends Seeder
{
    public function run()
    {
        // 1. Create a dedicated Test Driver
        $driverUser = User::updateOrCreate(
            ['email' => 'driver@merrymeals.com'],
            [
                'name' => 'Tatum Abernathy',
                'username' => 'testdriver',
                'password' => Hash::make('password'),
                'role' => User::ROLE_DRIVER,
                'phone' => '+1 555-8888',
                'address' => '789 Logistics Way, Hub City',
                'age' => 28,
            ]
        );

        // 2. Create Multiple Test Partners
        $partnersData = [
            [
                'email' => 'partner@merrymeals.com',
                'name' => 'Taste of Heritage Kitchen',
                'restaurantName' => 'Taste of Heritage Kitchen',
                'ownerName' => 'Chef Julian Rossi',
                'address' => '123 Culinary Ave, Food District',
            ],
            [
                'email' => 'nusantara@merrymeals.com',
                'name' => 'Nusantara Delights',
                'restaurantName' => 'Nusantara Delights',
                'ownerName' => 'Chef Siti Aminah',
                'address' => '45 Nusantara Blvd, Spice Island',
            ],
            [
                'email' => 'bali@merrymeals.com',
                'name' => 'Bali Heritage Bistro',
                'restaurantName' => 'Bali Heritage Bistro',
                'ownerName' => 'Chef Made Putu',
                'address' => '88 Ubud Street, Zen Valley',
            ],
        ];

        $partners = [];
        foreach ($partnersData as $pData) {
            $user = User::updateOrCreate(
                ['email' => $pData['email']],
                [
                    'name' => $pData['name'],
                    'username' => Str::slug($pData['name']),
                    'password' => Hash::make('password'),
                    'role' => User::ROLE_PARTNER,
                    'phone' => '+1 555-'.rand(1000, 9999),
                    'address' => $pData['address'],
                    'age' => rand(30, 50),
                ]
            );

            $partners[] = Partner::updateOrCreate(
                ['userID' => $user->id],
                [
                    'restaurantName' => $pData['restaurantName'],
                    'ownerName' => $pData['ownerName'],
                    'restaurantAddress' => $pData['address'],
                    'restaurantContact' => $user->phone,
                    'restaurantImage' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=800',
                    'foodType' => collect(['vegan friendly', 'non vegan friendly', 'halal-certified', 'vegetarian'])->random(),
                ]
            );
        }

        // 3. Seed 20 Meals for EACH Partner
        $mealTemplates = [
            ['name' => 'Heritage Beef Rendang', 'type' => 'Asian', 'ingredients' => 'Slow-cooked beef, coconut milk, galangal, lemongrass'],
            ['name' => 'Chicken Satay Royale', 'type' => 'Asian', 'ingredients' => 'Grilled chicken skewers, peanut sauce, lime, shallots'],
            ['name' => 'Gado-Gado Deluxe', 'type' => 'Vegetarian', 'ingredients' => 'Steamed vegetables, tofu, tempeh, rich peanut dressing'],
            ['name' => 'Nasi Goreng Special', 'type' => 'Asian', 'ingredients' => 'Fried rice, prawns, fried egg, chicken satay'],
            ['name' => 'Soto Ayam Signature', 'type' => 'Soup', 'ingredients' => 'Chicken soup, vermicelli, boiled egg, turmeric broth'],
            ['name' => 'Classic Truffle Pasta', 'type' => 'Western', 'ingredients' => 'Truffle oil, parmesan, heavy cream, fettuccine'],
            ['name' => 'Roasted Duck Plum', 'type' => 'Asian', 'ingredients' => 'Peking duck, plum sauce, scallions, cucumbers'],
            ['name' => 'Wagyu Beef Burger', 'type' => 'Western', 'ingredients' => 'Wagyu beef, brioche bun, aged cheddar, onions'],
            ['name' => 'Spicy Miso Ramen', 'type' => 'Japanese', 'ingredients' => 'Chashu pork, miso broth, nori, soft boiled egg'],
            ['name' => 'Grilled King Prawns', 'type' => 'Seafood', 'ingredients' => 'King prawns, garlic butter, lemon, parsley'],
            ['name' => 'Lamb Shank Braised', 'type' => 'Western', 'ingredients' => 'Lamb shank, red wine jus, mashed potato, carrots'],
            ['name' => 'Seafood Paella', 'type' => 'Mediterranean', 'ingredients' => 'Saffron rice, mussels, squid, prawns, peppers'],
            ['name' => 'Tofu Steak Teriyaki', 'type' => 'Vegan', 'ingredients' => 'Firm tofu, teriyaki sauce, sesame seeds, steamed broccoli'],
            ['name' => 'Salmon en Papillote', 'type' => 'Healthy', 'ingredients' => 'Salmon fillet, asparagus, lemon, herbs, parchment-baked'],
            ['name' => 'Lentil Shepherd Pie', 'type' => 'Vegan', 'ingredients' => 'Lentils, sweet potato mash, peas, vegetable gravy'],
            ['name' => 'Quinoa Harvest Bowl', 'type' => 'Healthy', 'ingredients' => 'Quinoa, roasted kale, chickpeas, avocado, tahini'],
            ['name' => 'Bibimbap Traditional', 'type' => 'Korean', 'ingredients' => 'Beef Bulgogi, kimchi, spinach, egg, gochujang'],
            ['name' => 'Dim Sum Basket', 'type' => 'Asian', 'ingredients' => 'Shumai, hakao, chicken feet, steamed buns'],
            ['name' => 'Butter Chicken', 'type' => 'Indian', 'ingredients' => 'Tandoori chicken, creamy tomato gravy, basmati rice'],
            ['name' => 'Pumpkin Sage Ravioli', 'type' => 'Italian', 'ingredients' => 'Roasted pumpkin, sage butter, ricotta, handmade pasta'],
        ];

        foreach ($partners as $partner) {
            foreach ($mealTemplates as $index => $tpl) {
                Meal::updateOrCreate(
                    ['mealName' => $tpl['name'].' ('.$partner->restaurantName.')', 'partnerID' => $partner->id],
                    [
                        'mealType' => $tpl['type'],
                        'mealIngredient' => $tpl['ingredients'],
                        'mealImage' => 'https://images.unsplash.com/photo-'.(1546060000 + ($index * 100)).'?w=800',
                        'mealDescription' => 'A masterfully crafted signature dish for the Merry Meals community.',
                        'mealAvailability' => 'available',
                    ]
                );
            }
        }

        // 4. Seed Orders (20 specifically for the test driver)
        $members = User::where('role', User::ROLE_MEMBER)->get();
        if ($members->isEmpty()) {
            $members = User::factory(10)->member()->create();
        }

        $allMeals = Meal::all();

        // Orders for the Driver
        for ($i = 0; $i < 20; $i++) {
            $partner = collect($partners)->random();
            $meal = $allMeals->where('partnerID', $partner->id)->random();
            $status = collect(['assigned', 'picked_up', 'in_transit'])->random();
            $createdAt = Carbon::now()->subHours(rand(1, 48));

            Order::create([
                'userID' => $members->random()->id,
                'partnerID' => $partner->id,
                'mealID' => $meal->id,
                'volunteerID' => $driverUser->id,
                'status' => $status,
                'mealPackage' => collect(['daily', 'weekly', 'monthly'])->random(),
                'foodTemperature' => collect(['hot', 'chilled'])->random(),
                'created_at' => $createdAt,
                'updated_at' => $status === 'assigned' ? $createdAt : $createdAt->addMinutes(rand(10, 30)),
            ]);
        }

        // Some completed orders for history
        for ($i = 0; $i < 20; $i++) {
            $partner = collect($partners)->random();
            $meal = $allMeals->where('partnerID', $partner->id)->random();
            $createdAt = Carbon::now()->subDays(rand(1, 30));

            Order::create([
                'userID' => $members->random()->id,
                'partnerID' => $partner->id,
                'mealID' => $meal->id,
                'volunteerID' => $driverUser->id,
                'status' => 'delivered',
                'mealPackage' => collect(['daily', 'weekly', 'monthly'])->random(),
                'foodTemperature' => collect(['hot', 'chilled'])->random(),
                'created_at' => $createdAt,
                'updated_at' => $createdAt->addHour(),
            ]);
        }
    }
}
