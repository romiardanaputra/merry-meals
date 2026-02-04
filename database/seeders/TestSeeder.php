<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Throwable;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            User::factory()->create();
            echo "Success\n";
        } catch (Throwable $e) {
            file_put_contents('seeder_error.txt', $e->getMessage()."\n".$e->getTraceAsString());
            throw $e;
        }
    }
}
