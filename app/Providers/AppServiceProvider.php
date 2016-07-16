<?php

namespace App\Providers;
use Validator;
use Illuminate\Support\ServiceProvider;
use App\DonValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages)
            {
                 //$translator -данные о локале, берется из app.conf
                 //$data - массив с данными
                 //$rule - название правила (required, max, min...)

                 return new DonValidator($translator, $data, $rules, $messages); // здесь мы добавили наш валидатор
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
