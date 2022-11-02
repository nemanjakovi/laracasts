<?php

namespace App\Providers;


use App\Services\Newsletter;
use Illuminate\Support\Fasades;
use MailchimpMarketing\ApiClient;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use App\Services\MailchimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
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
        app()->bind(Newsletter::class, function () {


            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us14'
            ]);

            return new MailchimpNewsletter($client);
        });
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
            return $user->username == 'nemanjakovi';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
