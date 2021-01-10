<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title'=> $this->faker->sentence(),
           'op1'=> $this->faker->words(3, true),  // كل اجابة متكونش اكتر من 3 كلمات
           'op2'=> $this->faker->words(3, true),  // كل اجابة متكونش اكتر من 3 كلمات
           'op3'=> $this->faker->words(3, true),  // كل اجابة متكونش اكتر من 3 كلمات
           'op4'=> $this->faker->words(3, true),  // كل اجابة متكونش اكتر من 3 كلمات
           'right_ans'=> $this->faker->numberbetween(1, 4), 

        ];
    }
}
