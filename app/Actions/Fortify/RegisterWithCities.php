<?php

namespace App\Actions\Fortify;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class RegisterWithCities implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {       
        Validator::make($input, [
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'string',
                'email',                
                Rule::unique(User::class),
            ],
            'phone' => ['required', 'unique:users'],
            'city_id' => ['required', 'exists:cities,id'],
            'type' => 'required',               
        ])->validate();

        $studentroleNum = Role::where('name', 'student')->first();
        return User::create([
            'name'      => $input['name'],
            'email'     => $input['email'],
            'phone'     => $input['phone'],
            'type'      => $input['type'],
            'city_id'   => $input['city_id'],
            'password'  => Hash::make($input['password']),
            'role_id'   => $studentroleNum->id,
        ]);
    }
}