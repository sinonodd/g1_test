<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chantiers', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->integer('lieu');
            $table->string('agence');
            $table->date('date_intervention');
            $table->date('date_fin');
            $table->enum('bon_command', ['OK', 'NOK', 'En course']);
            $table->enum('fiche_traveaux', ['OK', 'NOK', 'En course']);
            $table->enum('visite', ['OK', 'NOK', 'N/A']);
            $table->enum('materiel_dispo', ['OK', 'NOK', 'En course']);
            $table->enum('affectation_technique', ['OK', 'NOK', 'En course']);
            $table->enum('reservation_nacelle', ['OK', 'NOK', 'En course']);
            $table->enum('plan_prevention', ['OK', 'NOK', 'En course']);
            $table->enum('rdv_confirme', ['OK', 'NOK', 'En course']);
            $table->integer('prep_avancement');
            $table->enum('bon_reception', ['OK', 'NOK', 'En course']);
            $table->enum('rentabilite', ['OK', 'NOK', 'En course']);
            $table->enum('doe_envoye', ['OK', 'NOK', 'En course']);
            $table->enum('facturation_envoyee', ['OK', 'NOK', 'En course']);
            $table->integer('cloture_avancement');
            $table->integer('avancement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chantiers');
    }
};
