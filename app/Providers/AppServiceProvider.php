<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // app()->bind(Newsletter::class, function () {
        //     $client = (new ApiClient)->setConfig([
        //         'apiKey' => config('services.mailchimp.key'),
        //         'server' => 'us6'
        //     ]);

        //     return new MailchimpNewsletter($client);
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'Bashar';
        });

        Blade::if('admin', function () {
            return request()->user() ? request()->user()->can('admin') : null;
        });
    }
}
