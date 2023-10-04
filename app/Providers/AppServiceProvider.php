<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            // Lógica de validação do CPF
            // Você pode usar uma biblioteca externa ou escrever sua própria validação aqui
            // Retorne true se o CPF for válido e false caso contrário
            return true;
        });

        Validator::extend('nivel', function ($value) {

            if($value != '')
                return true;
            else
                return false;
        });
    }
}
