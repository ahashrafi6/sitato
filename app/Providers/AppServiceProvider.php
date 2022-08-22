<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Paginator::useBootstrap();

        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });


        View::composer(['site.layouts.menu', 'site.layouts.phone-menu'], function ($view) {
            $view->with([
                'menus' => Menu::Parents()->with('childs')->get(),
            ]);
        });
        View::composer(['site.layouts.header', 'site.profile.layouts.header', 'components.site.cart-modal'], function ($view) {
            $view->with([
                'cart_count' => session()->get('cart.total.count'),
            ]);
        });
        View::composer(['site.profile.layouts.header'], function ($view) {
            $user = auth()->user();
            $notifications = $user->unreadNotifications();
            $view->with([
                'user' => $user,
                'notifications' => $notifications->latest()->take(10)->get(),
                'notifications_count' => $notifications->count()
            ]);
        });


        // liara
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
