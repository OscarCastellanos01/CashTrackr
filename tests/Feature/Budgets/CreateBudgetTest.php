<?php

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('validates required fields when creating a budget', function() {
    $user = User::factory()->create([
        'email_verified_at' => now()
    ]);

    $response = $this->actingAs($user)
        ->from(route('budgets.create'))
        ->post(route('budget.store'), [
            'name' => '',
            'amount' => '',
            'type' => ''
        ]);

    $response->assertRedirect(route('budgets.create'));

    $response->assertSessionHasErrors([
        'name',
        'amount',
        'type'
    ]);
});

it('does not allow guest to create budget', function() {
    $response = $this->post(route('budget.store'), [
        'name' => 'Boda',
        'amount' => 1000,
        'type' => 'goal'
    ]);

    $response->assertRedirect(route('login'));
});

it('assigns the created budget to the authenticated user', function() {
    $user = User::factory()->create([
        'email_verified_at' => now()
    ]);

    $this->actingAs($user)->post(route('budget.store'), [
        'name' => 'Boda',
        'amount' => 1000,
        'type' => 'goal'
    ]);

    $this->assertDatabaseHas('budgets', [
        'name' => 'Boda',
        'amount' => 1000,
        'type' => 'goal',
        'user_id' => $user->id
    ]);
    
    $budget = Budget::first();
    expect($budget->user_id)->toBe($user->id);
});