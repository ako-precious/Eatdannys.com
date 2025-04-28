<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Soup', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Pastries', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Grills', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Meals', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

