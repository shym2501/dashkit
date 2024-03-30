<?php

namespace Database\Seeders;

use App\Models\FreeAsset;
use Illuminate\Database\Seeder;

class FreeAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FreeAsset::factory()
            ->count(5)
            ->create();
    }
}
