<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\RoleConstants;
use App\Events\UserCreatedEvent;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

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
        $adminRoleId = Role::query()->where('role', RoleConstants::ADMIN)->value('id');

        $admins = User::query()->whereHas('roles', function ($query) use ($adminRoleId) {
            $query->where('role_id', $adminRoleId);
        })->get();

        foreach ($admins as $admin) {
            UserNotification::query()->create([
                'user_id' => $admin->getKey(),
                'type' => 'push',
                'content' => 'User with id: ' . $this->id . 'has been registered'
            ]);
        }
    }

    protected $hidden = [
        'password',
        'remember_token',

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(UserWishlist::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
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

    public function isUser()
    {
        if($this->hasRole(RoleConstants::USER)) {
            return true;
        }else{
            return false;
        }
    }

    public function hasWishlist($wishList)
    {
        return $this->wishlists->contains('id', $wishList->id);
    }

}
