<?php

namespace Database\Factories;

use App\Models\Fichier;
use Illuminate\Database\Eloquent\Factories\Factory;

class FichierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fichier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
