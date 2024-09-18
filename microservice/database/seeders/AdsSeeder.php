<?php

namespace Database\Seeders;

use App\Models\Ads;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Ads::factory(10)->create();
    }
}
