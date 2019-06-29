<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App\Domain\User\Entities
 * @mixin \Eloquent
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $status
 * @property string $verify_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $role
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLE_VENDOR = 'vendor';

    public static function new(string $name, string $email, string $password)
    {
        $user = self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_ACTIVE
        ]);
        return $user;
    }

    public static function register(string $name, string $email, string $password)
    {
        $user = self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'verify_token' => Str::random(),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_WAIT,
            'email_verified_at' => time() + 604800
        ]);
        return $user;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isVendor(): bool
    {
        return $this->role === self::ROLE_VENDOR;
    }

    /**
     * @param $role
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public function changeRole($role): void
    {
        if (!in_array($role, self::getRoles(), true)) {
            throw new \InvalidArgumentException("Undefined role '$role'");
        }
        if ($this->role === $role) {
            throw new \DomainException('Role is already assigned.');
        }
        $this->update(['role' => $role]);
    }

    public static function getStatuses()
    {
        return [self::STATUS_ACTIVE, self::STATUS_WAIT];
    }

    public static function getRoles()
    {
        return [self::ROLE_USER, self::ROLE_ADMIN, self::ROLE_VENDOR];
    }


    /**
     * @throws \DomainException
     */
    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified');
        }
        self::update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }


    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'verify_token',
        'status',
        'created_at',
        'updated_at',
        'email_verified_at',
        'role'
    ];

    protected $hidden = [
        'password', 'remember_token', 'email_verified_at'
    ];

    protected $dateFormat = 'U';
}
