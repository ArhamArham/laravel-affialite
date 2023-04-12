<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:coupon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command install the all necessary modules';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Installing coupon');

        Artisan::call('sync:modules');
        Artisan::call('sync:blog-category');
        Artisan::call('coupon:seed');

        $this->comment('Today Coupon has been installed successfully.');

        return 0;
    }
}
