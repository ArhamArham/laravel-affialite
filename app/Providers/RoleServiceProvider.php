<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Module;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class RoleServiceProvider
{
    public static function define()
    {
        Gate::before(function ($user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        try {
            if (Schema::hasTable('tbl_modules')) {
                $permissions = self::getPermissions();
                foreach ($permissions as $permission) {
                    Gate::define($permission->key, static function ($user, $key = null) use ($permission) {
                        return $user->hasPermission($permission['permissions'], $permission->id, $key);
                    });
                }
            }
        } catch (Exception $e) {
        }
    }

    protected static function getPermissions()
    {
        try {
//            Cache::flush();
            return Cache::rememberForever('modules', function () {
                return Module::where('parent_id', null)
                    ->with(['children' => fn($q) => $q->orderBy('sort_by', 'asc')])
                    ->get()->pluck('children')
                    ->flatten(1);
            });
        } catch (Exception $e) {
            return [];
        }
    }
}
