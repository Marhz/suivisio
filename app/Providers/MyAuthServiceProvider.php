<?php

namespace App\Providers;

use App\Group;
use App\Policies\GroupPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider ;

class MyAuthServiceProvider extends AuthServiceProvider
{
    /**
     *
     * The policy mappings for the application.
     * @var array
     */
    protected $policies = [
        Group::class => GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
