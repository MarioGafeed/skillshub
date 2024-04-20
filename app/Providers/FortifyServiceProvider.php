<?php

namespace App\Providers;

use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\View;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\RegisterWithCities;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Auth\RegisterController;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        Fortify::createUsersUsing(RegisterController::class);
    }

    public function boot()
    {
        View::composer('auth.register', function ($view) {
            $cities = City::all();
            $view->with('cities', $cities);
        });
        
        Fortify::createUsersUsing(RegisterWithCities::class);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
// Add By Mario
        Fortify::registerView(function () {
        return view('auth.register');
    });
// Added By Mario
        Fortify::loginView(function () {
                return view('auth.login');
            });
// Add By mario
        // Fortify::verifyEmailView(function () {
        // return view('auth.verify-email');
        // });
// ِAdd By mario
        Fortify::requestPasswordResetLinkView(function () {
        return view('auth.forgot-password');
        });

// Add By Mario
        Fortify::resetPasswordView(function ($request) {
        return view('auth.reset-password', ['request' => $request]);

        
    });

    
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
    
}
