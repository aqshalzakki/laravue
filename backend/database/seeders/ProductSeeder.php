<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $items = [];
        foreach (range(1, 5) as $i) {
            $items[] = [
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph(2, false)
            ];
        }

        Product::insert($items);
    }
}
