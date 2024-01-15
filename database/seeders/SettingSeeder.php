<?php

namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
          'name' => 'SiteName',
          'email' => 'Contact@sitename.com',
          'phone' => '01096389912',
          'fb' => 'www.facebook.com',
          'tw' => 'www.twitter.com',
          'insta' => 'www.insta.com',
        ]);
    }
}
