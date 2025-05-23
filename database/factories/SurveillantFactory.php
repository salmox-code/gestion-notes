<?php 
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surveillant>
 */
class SurveillantFactory extends Factory
{
    public function definition(): array
    {
        $noms = ['El Idrissi', 'Benomar', 'Alaoui', 'Amrani', 'Kabbaj', 'Tahiri', 'El Fassi', 'Bouazza', 'Rahmouni', 'Ouazzani'];
        $prenoms = ['Omar', 'Youssef', 'Samira', 'Fatima', 'Hicham', 'Sara', 'Khalid', 'Nadia', 'Abdelhak', 'Layla'];

        return [
            'nom' => $this->faker->randomElement($noms),
            'prenom' => $this->faker->randomElement($prenoms),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
