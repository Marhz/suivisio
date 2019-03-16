<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Situation;
use App\Models\User;
use App\Models\Document;
use App\Models\MacAddress;
use App\Models\Poll;
use App\Policies\GroupPolicy;
use App\Policies\SituationPolicy;
use App\Policies\UserPolicy;
use App\Policies\MacAddressPolicy;
use App\Policies\PollPolicy;
use App\Policies\DocumentPolicy;

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
        Document::class => DocumentPolicy::class,
        MacAddress::class => MacAddressPolicy::class,
        Poll::class => PollPolicy::class,
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
