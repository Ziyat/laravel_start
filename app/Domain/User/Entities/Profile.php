<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * @package App\Domain\User\Entities
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $family_name
 * @property integer $birth_date
 * @property string $photo
 * @property string $nickname
 * @property string $gender
 */
class Profile extends Model
{
    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public function user()
    {
        return $this->hasOne(User::class);
    }

    protected $table = 'profiles';
}
