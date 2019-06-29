<?php

namespace App\Providers;

use App\Domain\User\Entities\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];

    /**
     * @throws \InvalidArgumentException
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin.panel', function (User $user) {
            return $user->isAdmin();
        });
    }
}
