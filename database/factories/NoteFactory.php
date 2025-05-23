<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Etudiant;
use App\Models\Matiere;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'etudiant_id' => Etudiant::inRandomOrder()->first()?->id ?? Etudiant::factory(),
            'matiere_id' => Matiere::inRandomOrder()->first()?->id ?? Matiere::factory(),
            'valeur' => $this->faker->randomFloat(2, 0, 20),
        ];
    }
}
