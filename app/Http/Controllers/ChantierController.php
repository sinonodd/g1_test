<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use Illuminate\Http\Request;

class ChantierController extends Controller
{
  public function index() {
      $chantiers = Chantier::orderBy('id', 'desc')->get();
      return response()->json($chantiers);
  }

  public function update(Request $request, $id) {
    $request->validate([
        'column' => 'required|string',
        'value' => 'required',
    ]);

    $validColumns = [
        'bon_command', 'fiche_traveaux', 'materiel_dispo', 'affectation_technique',
        'reservation_nacelle', 'plan_prevention', 'rdv_confirme', 'bon_reception',
        'rentabilite', 'doe_envoye', 'facturation_envoyee',
    ];

    if (!in_array($request->column, $validColumns)) {
        return response()->json(['error' => 'Invalid column name.'], 400);
    }

    $chantiers = Chantier::find($id);
    if (!$chantiers) {
        return response()->json(['error' => 'Project not found.'], 404);
    }

    $chantiers->update([$request->column => $request->value]);

    // Fields for preparation_avancement
    $prepFields = [
        'bon_command', 'fiche_traveaux', 'visite', 
        'materiel_dispo', 'affectation_technique', 
        'reservation_nacelle', 'plan_prevention', 'rdv_confirme',
    ];

    // Fields for closure_avancement
    $closureFields = [
        'bon_reception', 'rentabilite', 
        'doe_envoye', 'facturation_envoyee',
    ];

    // Calculate preparation_avancement
    $prepOkCount = collect($prepFields)
        ->filter(fn($field) => $chantiers->$field === 'OK')
        ->count();
    $prepAvancement = round(($prepOkCount / count($prepFields)) * 100);

    // Calculate closure_avancement
    $closureOkCount = collect($closureFields)
        ->filter(fn($field) => $chantiers->$field === 'OK')
        ->count();
    $closureAvancement = round(($closureOkCount / count($closureFields)) * 100);

    // Calculate global_avancement
    $globalAvancement = round(($prepAvancement + $closureAvancement) / 2);

    // Update the calculated fields
    $chantiers->update([
        'prep_avancement' => $prepAvancement,
        'cloture_avancement' => $closureAvancement,
        'avancement' => $globalAvancement,
    ]);
    return response()->json($chantiers);
  }

}
