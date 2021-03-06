<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Models\User;
use App\Observers\Users\UserObserver;

use App\Models\Comment;
use App\Observers\Comments\CommentObserver;

use App\Models\Group;
use App\Observers\Group\GroupObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Document\DocumentOpenedEvent' => ['App\Observers\Document\DocumentOpenedListener'],
        'App\Events\Document\DocumentUploadsEvent' => ['App\Observers\Document\DocumentUploadsListener'],
        'App\Events\Document\TeacherAcceptsEvent' => ['App\Observers\Document\TeacherAcceptsListener'],
        'App\Events\Document\TeacherRejectsEvent' => ['App\Observers\Document\TeacherRejectsListener'],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        User::observe(UserObserver::class);
        Comment::observe(CommentObserver::class);
        Group::observe(GroupObserver::class);
    }
}
