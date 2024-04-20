<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Laravel\Fortify\RegisteredUserController;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;


class RegisterController extends RegisteredUserController
{
    public function showRegistrationForm(): RegisterViewResponse
    {
        $cities = City::all();
        
    return Fortify::registerView()
        ->with('cities', $cities);
    }
}
