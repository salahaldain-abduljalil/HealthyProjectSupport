<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    //   Gate::define('appointments',function(User $user){

    //     return $user->ispsychologist = 1;

    //   });
    Gate::define('admin-user', function (User $user) {
        return $user->role === 'admin';
    });
    Gate::define('student-user', function (User $user) {
        return $user->role === 'student';
    });
    Gate::define('doctor-user', function (User $user) {
        return $user->role === 'psychologist';
    });
    }
}
