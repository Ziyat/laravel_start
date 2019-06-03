<?php

namespace App\Domain\User\Entities;

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
 * @property string $status
 * @property string $verify_token
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public static function new(string $name, string $email, string $password)
    {
        $user = self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
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

    protected $fillable = [
        'name',
        'email',
        'password',
        'verify_token',
        'status',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token', 'email_verified_at'
    ];

    protected $dateFormat = 'U';
}
