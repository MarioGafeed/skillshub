<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



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
          'phone' =>'01273443918',
          'password' => Hash::Make('123123'),
          'Role_id' => 1,
        ]);
    }
}
