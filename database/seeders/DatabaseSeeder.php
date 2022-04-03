<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(100)->create();
        $this->call([
            StatusSeeder::class,
            CategorySeeder::class,
            AssetSeeder::class,
            UserSeeder::class
        ]);
    }
}
