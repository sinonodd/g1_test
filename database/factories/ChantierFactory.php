<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\chantier>
 */
class ChantierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client' => fake()->name(),
            'lieu' => fake()->numberBetween(0, 100),
            'agence' => fake()->realText(10),
            'date_intervention' => fake()->date(),
            'date_fin' => fake()->date(),
            'bon_command' => 'NOK',
            'fiche_traveaux' => 'NOK',
            'visite' => 'N/A',
            'materiel_dispo' => 'NOK',
            'affectation_technique' => 'NOK',
            'reservation_nacelle' => 'NOK',
            'plan_prevention' => 'NOK',
            'rdv_confirme' => 'NOK',
            'prep_avancement' => 0,
            'bon_reception' => 'NOK',
            'rentabilite' => 'NOK',
            'doe_envoye' => 'NOK',
            'facturation_envoyee' => 'NOK',
            'cloture_avancement' => 0,
            'avancement' => 0,
        ];
    }
}
