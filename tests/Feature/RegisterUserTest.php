<?php

use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

uses(RefreshDatabase::class);

it('shows the registration screen', function() {
    $response = $this->get(route('register'));

    $response->assertOk();
    $response->assertStatus(200);

    $response->assertSee('Crear cuenta');

    $response->assertSeeInOrder([
        'Crear cuenta',
        'Email'
    ]);
});

it('register a new user as unverified and dispatches the registered event', function() {

    Event::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'Juan Perez',
        'email' => 'juan@juan.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    $response->assertRedirect(route('verification.notice'));

    $user = User::where('email', 'juan@juan.com')->first();

    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Juan Perez');
    expect($user->email)->toBe('juan@juan.com');
    expect($user->hasVerifiedEmail())->toBeFalse();

    Event::assertDispatched(Registered::class);
});

it('should validate required fields wwhen the request boyd is empyt', function() {
    $response = $this->post(route('register.store'), []);

    $response->assertSessionHasErrors([
        'name',
        'email',
        'password'
    ]);

    $response->assertSessionHasErrors([
        'name' => 'El Nombre es obligatorio',
        'email' => 'El E-mail es obligatorio',
        // 'password' => 'La contraseña es boligatoria'
    ]);
});

it('prevents duplicate email adresses', function() {

    User::factory()->create([
        'email' => 'juan@juan.com'
    ]);

    $response = $this->post(route('register.store'), [
        'name' => 'Juan Perez',
        'email' => 'juan@juan.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    $response->assertRedirect();

    $response->assertSessionHasErrors([
        'email' => 'Este correo ya esta registrado.'
    ]);
});

it('sends the verification email notification after registration', function() {

    Notification::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'Juan Perez',
        'email' => 'juan@juan.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ]);

    $user = User::where('email', 'juan@juan.com')->first();

    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Juan Perez');
    expect($user->email)->toBe('juan@juan.com');
    expect($user->hasVerifiedEmail())->toBeFalse();

    Notification::assertSentTo($user, VerifyEmail::class);
});

it('verifies the user email from a signed verification link', function() {

    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );
    
    $response = $this->actingAs($user)->get($verificationUrl);

    $response->assertRedirect(route('dashboard'));

    expect($user->hasVerifiedEmail())->toBeTrue();
});

it('does not allow an unverified user to acess the dashboard', function() {
    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertRedirect(route('verification.notice'));
});

it('allows a verified user to acess the dashboard', function() {
    $user = User::factory()->create([
        'email_verified_at' => now()
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();
});