<?php

namespace App\Console\Commands;

use App\Models\BlogCategory;
use Illuminate\Console\Command;

class SyncBlogCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:blog-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync the blog categories';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        foreach ($this->getCategories() as $name => $active) {
            BlogCategory::updateOrCreate([
                'name' => $name
            ], [
                'is_active' => $active
            ]);
        }
        return self::SUCCESS;
    }

    private function getCategories()
    {
        return [
            "Travel"  => 1,
            "Food"    => 1,
            "Style"   => 1,
            "Fitness" => 1,
            "Health"  => 1,
            "Sport"   => 1,
        ];
    }
}
