<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Post'        => 'App\Policies\PostPolicy',
        'App\Models\Media'       => 'App\Policies\MediaPolicy',
        'App\Models\Group'       => 'App\Policies\GroupPolicy',
        'App\Models\PostComment' => 'App\Policies\PostCommentPolicy',
        'App\Models\Tag'         => 'App\Policies\TagPolicy',
        'App\Models\Mail'        => 'App\Policies\MailPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
