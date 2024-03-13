<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        $profile = Profile::findOrNew(1);

        Config::set('mail.mailers.smtp.host', $profile->host);
        Config::set('mail.mailers.smtp.port', $profile->port);
        Config::set('mail.from.address', $profile->email);
        Config::set('mail.from.name', $profile->name);
        Config::set('mail.mailers.smtp.username', $profile->username);
        Config::set('mail.mailers.smtp.password', $profile->password);
    }
}
