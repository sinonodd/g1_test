<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    /** @use HasFactory<\Database\Factories\ChantierFactory> */
    use HasFactory;

    protected $fillable = [
        'client', 'lieu', 'agence', 'date_intervention', 'date_fin', 'bon_command', 'fiche_traveaux',
        'visite', 'materiel_dispo', 'affectation_technique', 'reservation_nacelle', 'plan_prevention',
        'rdv_confirme', 'prep_avancement', 'bon_reception', 'rentabilite', 'doe_envoye', 'facturation_envoyee',
        'cloture_avancement', 'avancement',
    ];

    // Function to calculate preparation_avancement
    public function calculatePreparationAvancement()
    {
        $fields = [
            'bon_command', 'fiche_traveaux', 'visite', 'materiel_dispo', 
            'affectation_technique', 'reservation_nacelle', 'plan_prevention', 
            'rdv_confirme'
        ];

        $okCount = collect($fields)
            ->filter(fn($field) => $this->$field === 'OK')
            ->count();

        return ($okCount / count($fields)) * 100; // Return percentage
    }

    // Function to calculate closure_avancement
    public function calculateClosureAvancement()
    {
        $fields = [
            'facturation_envoyee', 'doe_envoye', 'rentabilite', 'bon_reception'
        ];

        $okCount = collect($fields)
            ->filter(fn($field) => $this->$field === 'OK')
            ->count();

        return ($okCount / count($fields)) * 100; // Return percentage
    }
}
