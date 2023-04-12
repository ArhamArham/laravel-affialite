<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Deal;
use App\Models\Network;
use App\Models\Store;
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
        Network::factory(100)->create();
        Store::factory(100)->create();
        Coupon::factory(50)->create();
        Deal::factory(500)->create();
    }
}
