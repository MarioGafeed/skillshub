<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name' =>'Mario',
          'email' =>'admin@gmail.com',
          'password' => Hash::Make('123'),
          'Role_id' => 1,
        ]);
    }
}
