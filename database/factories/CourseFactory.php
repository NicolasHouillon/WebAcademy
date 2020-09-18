<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
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
            'name' => $this->faker->firstNameMale . " " . $this->faker->lastName,
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomFloat(null, 10, 100),
            'user_id' => 1,
            'subject_id' => Subject::all()->random()->id,
            'level_id' => Level::all()->random()->id,
        ];
    }
}
