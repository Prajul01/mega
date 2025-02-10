<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use App\Models\CheckJobExpiry;
use App\Models\NewsAndAnnouncement as News;
use View;
use Url;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if ($_SERVER['SERVER_NAME'] != '127.0.0.1') {
        //     URL::forceScheme('https');
        // }

        $jobChecker = new CheckJobExpiry;
        $jobChecker->check();

        View::composer('*', function ($view) {
            $setting = SiteSetting::findOrFail(1);
            $news = News::where('status', 'active')->limit(4)->get();
            $view->with('setting', $setting)
                ->with('news', $news);
        });

    }
}