<?php

namespace App\Providers;

use App\AdminMenus;
use App\Slides;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Menus;

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
        $response = array();

        $response['menu'] = Menus::all()->where('userLink','=','0');
        $response['slider'] = Slides::all();
        $response['userLinks'] = Menus::all()->where('userLink','=','1');
        $response['listLinks'] = AdminMenus::all()->where('listLink','=','1');
        $response['insertLinks'] = AdminMenus::all()->where('insertLink','=','1');

        view()->share($response);
    }
}
