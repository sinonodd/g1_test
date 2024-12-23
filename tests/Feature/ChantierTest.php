<?php

it('has chantier page', function () {
    $response = $this->get('/api/chantiers');

    $response->assertStatus(200);
});

it('lists all chantiers', function () {
    // Seed the database with some chantiers
    \App\Models\Chantier::factory()->count(5)->create();

    // Send a GET request to the list endpoint
    $response = $this->getJson('/api/chantiers');

    // Assert the response contains data
    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => ['id', 'client', 'lieu', 'agence', 'date_intervention', 'date_fin', 'bon_command'],
        ]);
});

it('updates a chantier successfully', function () {
    // Create a sample chantier
    $chantier = \App\Models\Chantier::factory()->create();

    // Prepare update data
    $updateData = [
        'column' => 'bon_command',
        'value' => 'OK',
    ];

    // Send a patch request to the update endpoint
    $response = $this->putJson("/api/chantiers/{$chantier->id}", $updateData);


    // Assert the response and database
    $response->assertStatus(200);
    $this->assertDatabaseHas('chantiers', [
        'id' => $chantier->id,
        'bon_command' => 'OK',
    ]);
});

