<?php

use App\Domain\User\Entities\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class, 10)->create();
    }
}
