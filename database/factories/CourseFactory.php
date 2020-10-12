<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomFloat(null, 10, 100),
            'user_id' => User::all()->where('group_id', 2)->random()->id,
            'subject_id' => Subject::all()->random()->id,
            'level_id' => Level::all()->random()->id,
        ];
    }
}
