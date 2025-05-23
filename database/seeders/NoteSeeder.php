<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        Etudiant::all()->each(function ($etudiant) {
            // Récupérer les matières correspondant au niveau de l'étudiant
            $matieres = Matiere::where('niveau', $etudiant->niveau)->get();

            foreach ($matieres as $matiere) {
                Note::updateOrCreate(
                    [
                        'etudiant_id' => $etudiant->id,
                        'matiere_id' => $matiere->id,
                    ],
                    [
                        'valeur' => rand(8, 17) + rand(0, 99) / 100.0
                    ]
                );
            }
        });
    }
}
