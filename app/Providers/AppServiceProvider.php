<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;


class AppServiceProvider extends ServiceProvider
{
 
  public function boot(){Password::defaults(function () {$rule = Password::min(8);

            return $this->app->isProduction()
                ? $rule->mixedCase()->uncompromised()
                : $rule->mixedCase()->uncompromised()
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}