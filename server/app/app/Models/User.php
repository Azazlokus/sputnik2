<?php

namespace App\Models;

use App\Constants\NotificationTypeConstants;
use App\Constants\RoleConstants;
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
        'first_name',
        'last_name'
    ];

    public static function boot(): void
    {
        parent::boot();
        static::created(function (self $model) {
            $model->sendNotificationsToAdmins();
            $model->attachDefaultRole();
        });
    }

    private function attachDefaultRole()
    {
        $this->roles()->attach(Role::query()->where('role', RoleConstants::USER)->first());
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
                'type' => NotificationTypeConstants::PUSH,
                'content' => 'User with id: ' . $this->id . ' has been registered',
                'created_at' => now(),
                'updated_at' => now(),
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
        return $this->belongsToMany(Role::class, 'role_users');
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
    //hasRole как будто бы ставит под сомнение надобность методов isUser/isAdmin/isBlocked
    public function hasRole($roleName) : bool
    {
        return $this->roles->contains('role', $roleName);
    }

    public function isUser(): bool
    {
        return $this->hasRole(RoleConstants::USER);
    }
    public function isAdmin(): bool
    {
        return $this->hasRole(RoleConstants::ADMIN);
    }
    public function isBlocked(): bool
    {
        return $this->hasRole(RoleConstants::USER_BLOCKED);
    }
    public  function hasWishlist($wishList)
    {
        return $this->wishlists->contains('id', $wishList->id);
    }

}
