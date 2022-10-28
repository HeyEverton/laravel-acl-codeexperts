<?php

namespace App\Providers;

use App\Models\Resource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Thread' => 'App\Policies\ThreadPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $resources = Resource::all();

        Gate::before(function($user) {
            return $user->isAdmin();

        });

        foreach ($resources as $resource) {

            Gate::define($resource->resource, function($user) use ($resource) {
              return $resource->roles->contains($user->role);

            });
        }
    }
}
