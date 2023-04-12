<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SyncModule extends Command
{
    public const CREATE = 'Create';
    public const VIEW = 'View';
    public const DELETE = 'Delete';
    public const UPDATE = 'Update';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:modules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync the modules';

    public static function getAllModules(): array
    {
        return (new static)->getModules();
    }

    private function getModules(): array
    {
        return [
            [
                'name'      => 'User Management',
                'key'       => 'userManagement',
                'is_active' => true,
                'children'  => [
                    [
                        'name'        => 'User',
                        'key'         => 'user',
                        'is_active'   => true,
                        'sort_by'     => 1,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                    [
                        'name'        => 'Role',
                        'key'         => 'role',
                        'is_active'   => true,
                        'sort_by'     => 2,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                ]
            ],
            [
                'name'      => 'Market',
                'key'       => 'market',
                'is_active' => true,
                'children'  => [
                    [
                        'name'        => 'Network',
                        'key'         => 'network',
                        'is_active'   => true,
                        'sort_by'     => 1,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                    [
                        'name'        => 'Category',
                        'key'         => 'category',
                        'is_active'   => true,
                        'sort_by'     => 2,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                ]
            ],
            [
                'name'      => 'Affiliate',
                'key'       => 'affiliate',
                'is_active' => true,
                'children'  => [
                    [
                        'name'        => 'Store',
                        'key'         => 'store',
                        'is_active'   => true,
                        'sort_by'     => 1,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                    [
                        'name'        => 'Coupon Sorting',
                        'key'         => 'coupon.sorting',
                        'is_active'   => true,
                        'sort_by'     => 2,
                        'permissions' => [
                            'index'  => self::VIEW,
                            'create' => self::CREATE,
                        ]
                    ],
                    [
                        'name'        => 'Coupon',
                        'key'         => 'coupon',
                        'is_active'   => true,
                        'sort_by'     => 3,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                ]
            ],
            [
                'name'      => 'Advertisement',
                'key'       => 'advertisement',
                'is_active' => true,
                'children'  => [
                    [
                        'name'        => 'Deal',
                        'key'         => 'Deal',
                        'is_active'   => true,
                        'sort_by'     => 1,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                    [
                        'name'        => 'Blog',
                        'key'         => 'blog',
                        'is_active'   => true,
                        'sort_by'     => 2,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                    [
                        'name'        => 'Page',
                        'key'         => 'page',
                        'is_active'   => true,
                        'sort_by'     => 3,
                        'permissions' => [
                            'index'   => self::VIEW,
                            'create'  => self::CREATE,
                            'update'  => self::UPDATE,
                            'destroy' => self::DELETE
                        ]
                    ],
                ]
            ],
            [
                'name'      => 'Setting',
                'key'       => 'setting',
                'is_active' => true,
                'children'  => [
                    [
                        'name'        => 'Website',
                        'key'         => 'Deal',
                        'is_active'   => true,
                        'sort_by'     => 1,
                        'permissions' => [
                            'index'  => self::VIEW,
                            'create' => self::CREATE,
                        ]
                    ],
                ]
            ],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Syncing modules");

        foreach ($this->getModules() as $module) {
            $moduleModel = Module::updateOrCreate([
                'key' => $module['key'],
            ], [
                'name'      => $module['name'],
                'is_active' => $module['is_active']
            ]);

            foreach ((array)@ $module['children'] as $child) {
                $moduleModel->children()->updateOrCreate([
                    'key' => "{$module['key']}.{$child['key']}",
                ], [
                    'name'        => $child['name'],
                    'permissions' => $child['permissions'],
                    'is_active'   => $module['is_active'] && $child['is_active'],
                    'sort_by'     => $child['sort_by']
                ]);
            }
        }

        Cache::flush();

        $this->comment("Module synced successfully");
        return 0;
    }
}
