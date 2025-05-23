<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EtudiantFactory extends Factory
{
    public function definition()
    {
        // Stock static des combinaisons possibles
        static $combinations = [];
        static $used = [];

        if (empty($combinations)) {
            $noms = ['Bennani', 'El Amrani', 'nechda', 'dadda', 'menouar', 'Moujahid', 'Zahidi', 'Tahiri', 'Bencheikh', 'Qachach'];
            $prenoms = ['Omar', 'Youssef', 'Salma', 'Imane', 'Mohamed', 'Rania', 'Zakaria', 'Aya', 'Ismail', 'Sara'];

            foreach ($noms as $nom) {
                foreach ($prenoms as $prenom) {
                    $combinations[] = [$nom, $prenom];
                }
            }

            shuffle($combinations); // mélanger pour éviter l'ordre
        }

        if (count($used) >= count($combinations)) {
            throw new \Exception('Plus de combinaisons nom+prenom disponibles.');
        }

        $combinaison = $combinations[count($used)];
        $used[] = $combinaison;

        return [
            'nom' => $combinaison[0],
            'prenom' => $combinaison[1],
            'email' => $this->faker->unique()->safeEmail(),
            'cne' => strtoupper(Str::random(10)),
            'niveau' => $this->faker->randomElement(['CP1', 'CP2', 'DATA1', 'TDIA1']),
            'filiere' => $this->faker->randomElement(['DATA', 'TDIA']),
            'classe_id' => null,
        ];
    }
}

