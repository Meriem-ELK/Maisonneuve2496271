<?php

namespace Database\Factories;
use App\Models\Ville;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'adresse' => $this->faker->address(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'date_naissance' => $this->faker->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
            'ville_id' => Ville::inRandomOrder()->value('id')
        ];
    }
}
