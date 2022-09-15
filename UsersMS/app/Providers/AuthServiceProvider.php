<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        if (!$this->app->routesAreCached()) {
            Passport::routes();
            Passport::tokensExpireIn(now()->addDays(15));
            Passport::refreshTokensExpireIn(now()->addDays(30));
            Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        }
        //Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');

        // Gate::define('admin',function($user){
        //     return Auth::user()->user_type;
        // });
        // Gate::define('admin',function($user){
        //     return $role = Auth::user()->user_type='admin';
        // });
        // Gate::define('student',function($user){
        //     return $role=Auth::user()->user_type='student';
        // });
        // Gate::define('teacher',function($user){
        //     return $role=Auth::user()->user_type='teacher';
        // });
    }
}
