<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// ✅ Import correct du modèle User
use App\Models\User;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Classe;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Création des comptes administrateurs
        User::create([
            'name' => 'Salma Nechda',
            'email' => 'salma@admin.com',
            'password' => Hash::make('salma1234'),
        ]);

        User::create([
            'name' => 'Rayhana Hamriti',
            'email' => 'rayhana@admin.com',
            'password' => Hash::make('rayhana1234'),
        ]);

        // 🏫 Création des classes
        $classes = [
            'CP1' => Classe::create(['nom' => 'CP1']),
            'CP2' => Classe::create(['nom' => 'CP2']),
            'DATA1' => Classe::create(['nom' => 'DATA1']),
            'TDIA1' => Classe::create(['nom' => 'TDIA1']),
        ];

        // 📘 Définition des matières par niveau
        $matieres = [
            'CP1' => ["Mathématiques générales", "Physique I", "Chimie", "Algorithmique", "Intro info", "Expression écrite", "Méthodologie"],
            'CP2' => ["Analyse", "Physique II", "POO Java", "Statistiques", "Électronique", "Communication", "Structure Ordinateur"],
            'DATA1' => ["ML", "Big Data", "Stats avancées", "Python DS", "DataViz", "Syst. distribué", "Analyse données"],
            'TDIA1' => ["Web avancé", "Cloud", "Réseaux", "DevOps", "Cybersécurité", "BDD avancée", "Laravel"]
        ];

        // 👤 Génération des étudiants + matières
        foreach ($classes as $niveau => $classe) {
            Etudiant::factory()->count(20)->create([
                'niveau' => $niveau,
                'classe_id' => $classe->id,
            ]);

            foreach ($matieres[$niveau] as $nomMatiere) {
                Matiere::create([
                    'nom' => $nomMatiere,
                    'niveau' => $niveau,
                    'code' => strtoupper(substr($nomMatiere, 0, 3)) . rand(100, 999),
                    'semestre' => 1,
                    'classe_id' => $classe->id,
                ]);
            }
        }

        // 📚 Génération des notes
        $this->call(NoteSeeder::class);
    }
}
