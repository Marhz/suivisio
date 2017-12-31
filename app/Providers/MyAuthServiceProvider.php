<?php

namespace App\Providers;

use App\Group;
use App\Situation;
use App\User;
use App\Policies\GroupPolicy;
use App\Policies\SituationPolicy;
use App\Policies\UserPolicy;

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
        User::class => UserPolicy::class,
        Situation::class => SituationPolicy::class,
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
