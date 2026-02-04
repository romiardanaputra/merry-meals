<?php

namespace Database\Seeders;

use App\Models\Geolocation;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Partner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * BaliLocationSeeder
 *
 * Creates test data with REAL Bali locations within 10km delivery radius.
 * Central point: Denpasar (-8.6705, 115.2126)
 *
 * Run with: php artisan db:seed --class=BaliLocationSeeder
 */
class BaliLocationSeeder extends Seeder
{
    /**
     * Real Bali locations within ~10km radius of Denpasar
     */
    private array $baliLocations = [
        // Central Denpasar Area
        [
            'name' => 'Jl. Teuku Umar No.112, Denpasar',
            'lat' => -8.6639,
            'lng' => 115.2126,
            'area' => 'Denpasar Barat',
        ],
        [
            'name' => 'Jl. Gatot Subroto Timur No.45, Denpasar',
            'lat' => -8.6368,
            'lng' => 115.2367,
            'area' => 'Denpasar Timur',
        ],
        [
            'name' => 'Jl. Imam Bonjol No.88, Pemecutan Kelod',
            'lat' => -8.6583,
            'lng' => 115.2011,
            'area' => 'Denpasar Barat',
        ],
        [
            'name' => 'Jl. Hayam Wuruk No.168, Sumerta',
            'lat' => -8.6467,
            'lng' => 115.2369,
            'area' => 'Denpasar Timur',
        ],
        // Sanur Area (~6km from center)
        [
            'name' => 'Jl. Danau Tamblingan No.88, Sanur',
            'lat' => -8.6931,
            'lng' => 115.2625,
            'area' => 'Sanur',
        ],
        [
            'name' => 'Jl. Bypass Ngurah Rai No.21, Sanur Kauh',
            'lat' => -8.7083,
            'lng' => 115.2531,
            'area' => 'Sanur',
        ],
        // Renon Area (~4km from center)
        [
            'name' => 'Jl. Raya Puputan No.77, Renon',
            'lat' => -8.6722,
            'lng' => 115.2358,
            'area' => 'Renon',
        ],
        [
            'name' => 'Jl. Tukad Pakerisan No.12, Panjer',
            'lat' => -8.6839,
            'lng' => 115.2264,
            'area' => 'Panjer',
        ],
        // Sesetan Area (~5km from center)
        [
            'name' => 'Jl. Raya Sesetan No.155, Sesetan',
            'lat' => -8.6994,
            'lng' => 115.2161,
            'area' => 'Sesetan',
        ],
        // Kerobokan Area (~9km from center)
        [
            'name' => 'Jl. Raya Kerobokan No.88, Kerobokan',
            'lat' => -8.6758,
            'lng' => 115.1633,
            'area' => 'Kerobokan',
        ],
    ];

    /**
     * Partner/Restaurant locations in Bali (pickup points)
     */
    private array $partnerLocations = [
        [
            'name' => 'Warung Babi Guling Pak Malen',
            'address' => 'Jl. Sulawesi No.2, Denpasar',
            'lat' => -8.6558,
            'lng' => 115.2194,
        ],
        [
            'name' => 'Bebek Bengil Ubud Style',
            'address' => 'Jl. Hanoman No.35, Denpasar',
            'lat' => -8.6631,
            'lng' => 115.2283,
        ],
    ];

    public function run()
    {
        $now = Carbon::now();
        $password = Hash::make('password');
        $defaultPhone = '6285792479249'; // User's phone number

        // ============================================
        // 1. Create/Update Partner with real Bali location
        // ============================================
        $partnerUser = User::updateOrCreate(
            ['email' => 'partner.bali@merrymeals.com'],
            [
                'name' => 'Warung Babi Guling Pak Malen',
                'username' => 'partnerbali',
                'password' => $password,
                'role' => User::ROLE_PARTNER,
                'phone' => '62361234567',
                'address' => $this->partnerLocations[0]['address'],
                'age' => 45,
            ]
        );

        $partner = Partner::updateOrCreate(
            ['userID' => $partnerUser->id],
            [
                'restaurantName' => $this->partnerLocations[0]['name'],
                'ownerName' => 'Pak Malen',
                'restaurantAddress' => $this->partnerLocations[0]['address'],
                'restaurantContact' => '62361234567',
                'restaurantImage' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800',
                'foodType' => 'non vegan friendly',
            ]
        );

        // Create geolocation for partner
        Geolocation::updateOrCreate(
            ['userID' => $partnerUser->id],
            [
                'partnerID' => $partner->id,
                'ip' => '127.0.0.1',
                'countryName' => 'Indonesia',
                'countryCode' => 'ID',
                'regionName' => 'Bali',
                'cityName' => 'Denpasar',
                'latitude' => (string) $this->partnerLocations[0]['lat'],
                'longitude' => (string) $this->partnerLocations[0]['lng'],
            ]
        );

        // ============================================
        // 2. Create Balinese Meals
        // ============================================
        $baliMeals = [
            ['name' => 'Babi Guling Komplit', 'type' => 'Asian', 'desc' => 'Traditional Balinese suckling pig with rice and lawar'],
            ['name' => 'Ayam Betutu', 'type' => 'Asian', 'desc' => 'Slow-cooked chicken in rich Balinese spices'],
            ['name' => 'Sate Lilit Ikan', 'type' => 'Seafood', 'desc' => 'Minced fish satay with coconut and lime leaves'],
            ['name' => 'Lawar Merah', 'type' => 'Asian', 'desc' => 'Traditional Balinese chopped meat salad'],
            ['name' => 'Nasi Campur Bali', 'type' => 'Asian', 'desc' => 'Mixed rice with various Balinese side dishes'],
        ];

        $mealImages = [
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
        ];

        $createdMeals = [];
        foreach ($baliMeals as $i => $meal) {
            $createdMeals[] = Meal::updateOrCreate(
                ['mealName' => $meal['name'], 'partnerID' => $partner->id],
                [
                    'mealIngredient' => $meal['desc'],
                    'mealImage' => $mealImages[$i % 2],
                    'mealDescription' => $meal['desc'],
                    'mealType' => $meal['type'],
                    'mealAvailability' => 'Available',
                ]
            );
        }

        // ============================================
        // 3. Create Members with Real Bali Addresses
        // ============================================
        $members = [];
        $memberNames = ['Wayan Sudiarta', 'Made Kartika', 'Nyoman Sari', 'Ketut Dharma', 'Wayan Adi'];

        foreach ($this->baliLocations as $i => $location) {
            if ($i >= 5) {
                break;
            } // Create 5 members

            $member = User::updateOrCreate(
                ['email' => "member.bali{$i}@merrymeals.com"],
                [
                    'name' => $memberNames[$i],
                    'username' => "memberbali{$i}",
                    'password' => $password,
                    'role' => User::ROLE_MEMBER,
                    'phone' => $defaultPhone, // User's phone number
                    'address' => $location['name'],
                    'age' => rand(65, 80),
                ]
            );

            // Create geolocation for member
            Geolocation::updateOrCreate(
                ['userID' => $member->id],
                [
                    'ip' => '127.0.0.1',
                    'countryName' => 'Indonesia',
                    'countryCode' => 'ID',
                    'regionName' => 'Bali',
                    'cityName' => $location['area'],
                    'latitude' => (string) $location['lat'],
                    'longitude' => (string) $location['lng'],
                ]
            );

            $members[] = $member;
        }

        // ============================================
        // 4. Create/Update Driver
        // ============================================
        $driver = User::updateOrCreate(
            ['email' => 'driver.bali@merrymeals.com'],
            [
                'name' => 'Kadek Driver',
                'username' => 'driverbali',
                'password' => $password,
                'role' => User::ROLE_DRIVER,
                'phone' => $defaultPhone,
                'address' => 'Jl. Diponegoro No.50, Denpasar',
                'age' => 28,
            ]
        );

        // ============================================
        // 5. Create Active Orders for Driver Dashboard Testing
        // ============================================
        $statuses = [
            Order::STATUS_ASSIGNED,
            Order::STATUS_PICKED_UP,
            Order::STATUS_IN_TRANSIT,
        ];
        $packages = ['daily', 'weekly'];
        $temps = ['hot', 'cold'];
        $deliveryNotes = [
            'Rumah pagar hijau, ketuk keras',
            'Taruh di meja depan jika tidak ada orang',
            'Hubungi sebelum sampai',
            null,
            'Jangan bungkus plastik, bawa wadah sendiri',
        ];

        // Delete old test orders for this driver
        Order::where('volunteerID', $driver->id)->delete();

        foreach ($members as $i => $member) {
            Order::create([
                'userID' => $member->id,
                'partnerID' => $partner->id,
                'mealID' => $createdMeals[$i % count($createdMeals)]->id,
                'volunteerID' => $driver->id,
                'status' => $statuses[$i % count($statuses)],
                'mealPackage' => $packages[array_rand($packages)],
                'foodTemperature' => $temps[array_rand($temps)],
                'range' => $this->calculateDistance(
                    $this->partnerLocations[0]['lat'],
                    $this->partnerLocations[0]['lng'],
                    $this->baliLocations[$i]['lat'],
                    $this->baliLocations[$i]['lng']
                ),
                'deliveryNotes' => $deliveryNotes[$i],
                'created_at' => $now->copy()->subMinutes(rand(10, 120)),
            ]);
        }

        $this->command->info('✅ Bali Location Seeder completed!');
        $this->command->info('   - 1 Partner (pickup point in Denpasar)');
        $this->command->info('   - 5 Members with real Bali addresses');
        $this->command->info('   - 1 Driver assigned to orders');
        $this->command->info('   - 5 Active orders for testing');
        $this->command->info("\n📱 All members use phone: {$defaultPhone}");
    }

    /**
     * Calculate distance between two GPS coordinates in kilometers
     */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2): float
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 1);
    }
}
