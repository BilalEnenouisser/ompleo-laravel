<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use App\Models\UserNotification;
use App\Policies\ApplicationPolicy;
use App\Policies\BlogPolicy;
use App\Policies\CompanyPolicy;
use App\Policies\JobPolicy;
use App\Policies\UserPolicy;
use App\Policies\UserNotificationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Job::class => JobPolicy::class,
        Application::class => ApplicationPolicy::class,
        Company::class => CompanyPolicy::class,
        User::class => UserPolicy::class,
        Blog::class => BlogPolicy::class,
        UserNotification::class => UserNotificationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
