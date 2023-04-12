<?php

namespace App\Models;

use App\Traits\HasApiWhere;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasApiWhere, Notifiable;

    protected $table = 'tbl_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        parent::creating(static function ($user) {
            $user->name = $user->first_name . " " . $user->last_name;
            $user->password = bcrypt($user->password);
        });

        parent::updating(static function ($user) {
            $user->name = $user->first_name . " " . $user->last_name;
        });
    }

    public function isSuperAdmin(): bool
    {
        return $this->id == 1;
    }

    public function hasPermission($totalPermissions, $module_id, $key): bool
    {
        $totalPermissions = collect($totalPermissions)
            ->keys()
            ->toArray();

        Session::put('roles', auth()->user()->roles()
            ->with('rolePermissions')
            ->get()->pluck('rolePermissions')
            ->flatten(1)
            ->mapToGroups(function ($item, $key) {
                return [$item['module_id'] => $item['permissions']];
            })->map
            ->flatten(1)
        );

        $roles = Session::get('roles')
                ->get((string)$module_id) ?? collect([]);

        $counts = $roles->intersect($totalPermissions)->count();

        if ($key) {
            return $counts && in_array($key, $roles->toArray(), true);
        }

        return $counts;
    }

    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'tbl_user_role');
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }

    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class);
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }
}
