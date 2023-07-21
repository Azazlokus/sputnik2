<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\RoleConstants;
use App\Events\UserCreatedEvent;
use App\Policies\WishlistPolicy;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public static function boot(): void
    {
        self::created(fn(self $model) => $model->sendNotificationsToAdmins());
        parent::boot();
        static::created(function ($user) {
            $defaultRole = Role::query()->where('role', RoleConstants::USER)->first();
            if ($defaultRole) {
                $user->roles()->attach($defaultRole);
            }
        });
    }
    public function sendNotificationsToAdmins()
    {
        $adminRoleId = Role::query()->where('role', \App\Constants\RoleConstants::ADMIN)->value('id');

        $admins = User::query()->whereHas('roles', function ($query) use ($adminRoleId) {
            $query->where('role_id', $adminRoleId);
        })->get();

        foreach ($admins as $admin) {
            UserNotification::query()->create([
                'user_id' => $admin->getKey(),
                'type' => 'push',
                'content' => 'User '. $this->username . 'has been registered'
            ]);
        }
    }
    protected $fillable = [
        'id',
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
        'password' => 'hashed',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    public function wishlists():BelongsToMany
    {
        return $this->belongsToMany(WishlistPolicy::class);
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function hasRole($roleName)
    {
        return $this->roles->contains('role', $roleName);
    }
    public function hasWishlist($wishList)
    {
        return $this->wishlists()->contains('id', $wishList->id);
    }

}
