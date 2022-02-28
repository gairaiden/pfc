<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Date;
use App\Models\Memo;


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
        view()->composer('*',function($view){
            $user = \Auth::user();

            $memoModel = new Memo();
            $memos = $memoModel->myMemo( \Auth::id() );

            $dateModel = new Date();
            $dates = $dateModel->where('user_id',\Auth::id())->get();

            $view->with('user',$user)->with('memos',$memos)->with('dates',$dates);
        });
        Schema::defaultStringLength(191);
        if ($this->app->environment() == 'production') {
            URL::forceScheme('https');
        }
    }
}