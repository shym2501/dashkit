<?php

namespace Database\Seeders;

use App\Models\FlashSale;
use Illuminate\Database\Seeder;

class FlashSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FlashSale::factory()
            ->count(5)
            ->create();
    }
}
