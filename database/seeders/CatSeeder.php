<?php

namespace Database\Seeders;
use App\Models\Cat;
use App\Models\Skill;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   // Error Here
      //  Cat::factory()->has(
      //    Skill::Factory()->has(
      //      Exam::Factory()->has(
      //         Question::Factory()->count(15)
      //        )->count(2)
      //      )->count(8)
      //    )->count(5)->create();
    }
}
