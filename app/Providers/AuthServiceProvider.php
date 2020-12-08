<?php

namespace App\Providers;

use App\Models\User\UserModel;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
       // $this->registerPolicies();

        //
        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return UserModel::where('api_token', $request->input('api_token'))->first();
            }
        });
    }
}
