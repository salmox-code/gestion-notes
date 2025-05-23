<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MatiereFactory extends Factory
{
    public function definition()
    {
        $matieresParNiveau = [
            'CP1' => ["Mathématiques générales", "Physique I", "Chimie", "Algorithmique", "Intro info", "Expression écrite", "Méthodologie"],
            'CP2' => ["Analyse", "Physique II", "POO Java", "Statistiques", "Électronique", "Communication", "Structure Ordinateur"],
            'DATA1' => ["ML", "Big Data", "Stats avancées", "Python DS", "DataViz", "Syst. distribué", "Analyse données"],
            'TDIA1' => ["Web avancé", "Cloud", "Réseaux", "DevOps", "Cybersécurité", "BDD avancée", "Laravel"]
        ];

        $niveau = $this->faker->randomElement(array_keys($matieresParNiveau));
        $nom = $this->faker->randomElement($matieresParNiveau[$niveau]);

        return [
            'nom' => $nom,
            'niveau' => $niveau,
        ];
    }
}
