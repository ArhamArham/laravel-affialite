<?php

namespace App\Http\Middleware;

use App\Models\Module;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach ($this->getPermissions() as $permission) {
            if ($request->routeIs($permission->key . ".*")) {

                if (Gate::forUser(auth()->user())
                    ->allows($permission->key,
                        $this->getKey($permission)
                    )) {
                    break;
                }
                abort(403);
            }
        }
        return $next($request);
    }

    protected function getPermissions()
    {
        try {
//            Cache::flush();
            return Cache::rememberForever('modules', static function () {
                return Module::where('parent_id', null)
                    ->with(['children' => fn($q) => $q->orderBy('sort_by', 'asc')])
                    ->get()->pluck('children')
                    ->flatten(1);
            });
        } catch (Exception $e) {
            return [];
        }
    }

    private function getKey($permission)
    {
        $key = $permission->key;
        $lastKey = @ Arr::last(@ explode('.', request()?->route()?->getName()));

        $swapKeys = [
            'store' => 'create',
            'edit'  => 'update'
        ];

        return (Str::contains($lastKey, $key) ?
            null : isset($swapKeys[$lastKey])) ?
            $swapKeys[$lastKey] : $lastKey;
    }
}
