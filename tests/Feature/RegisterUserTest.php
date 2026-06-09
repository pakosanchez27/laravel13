<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;




uses(RefreshDatabase::class);

test('shows the registration screem', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);

    $response->assertSee('Crear Cuenta');
});

it('register a new user as unverified and dispatches the registered event', function () {

    Event::fake();

    $response = $this->post(route('register'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('verification.notice'));

    $user = User::where('email', 'john@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->name)->toBe('John Doe');
    expect($user->email)->toBe('john@example.com');
    expect($user->hasVerifiedEmail())->toBeFalse();

    Event::assertDispatched(Registered::class);
});

it(
    'should validate required fields when the request body is empty',
    function () {
        $response = $this->post(route('register'), []);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
);

it('Prevents duplicate email registration', function () {

    User::factory()->create([
        'email' => 'john@example.com'
    ]);

    $response = $this->post(route('register'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
    $response->assertSessionHasErrors(['email']);
});
