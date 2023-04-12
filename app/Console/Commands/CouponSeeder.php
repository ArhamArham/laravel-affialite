<?php

namespace App\Console\Commands;

use App\Models\Network;
use App\Models\Role;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CouponSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will seed the dummy data into today Crm';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Seeding today coupon");

        Network::create([
            'name' => 'Geo'
        ]);

        Network::create([
            'name' => 'Telemart'
        ]);

        Role::create([
            'name' => 'Lms',
        ])->rolePermissions()
            ->createMany([
                [
                    'module_id'   => 2,
                    'permissions' => ['index']
                ]
            ]);

        Role::create([
            'name' => 'Manager',
        ])->rolePermissions()
            ->createMany([
                [
                    'module_id'   => 6,
                    'permissions' => ['create']
                ]
            ]);

        User::create([
            'network_id' => Network::inRandomOrder()->first()->id,
            'first_name' => 'Arham',
            'last_name'  => 'Roshan',
            'username'   => 'arhamroshan',
            'email'      => 'arham@gmail.com',
            'password'   => 'Arham110@'
        ])->roles()->sync([1]);

        User::create([
            'network_id' => Network::inRandomOrder()->first()->id,
            'first_name' => 'Noman',
            'last_name'  => 'Khan',
            'username'   => 'nomankhan',
            'email'      => 'noman@gmail.com',
            'password'   => 'Arham110@'
        ])->roles()->sync([2]);

        Artisan::call('db:seed');

        $this->comment("Seeding has been completed");

        return 0;
    }
}
